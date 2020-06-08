<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AuctionMedias;
use App\AuctionSlot;
use App\AutoBid;
use App\Bid;
use App\Events\BidUpdate;
use App\Http\Requests\AuctionRequest;
use App\Product;
use App\Sales;
use App\ShippingCost;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AuctionController extends Controller
{

    public function index()
    {
        $auctions=Auction::with('product.category')->get();
        return view('admin.pages.auction.manage',['auctions'=>$auctions]);
    }


    public function create()
    {
        $products = Product::whereStatus(1)->get();
        return view('admin.pages.auction.create', ['products' => $products]);
    }


    public function store(AuctionRequest $request)
    {
        $auction = Auction::create($request->except('files','images','duration_time','slot_number'));

        $this->addSlot($request, $auction);
        $this->addImage($request, $auction);

        return redirect('/admin/auction/create')
            ->with(['type' => 'success', 'message' => 'Auction created Successfully']);
    }

    public function showAuction(Request $request, $id) {
        $auction = Auction::find($id);
        return view('admin.pages.auction.show', ['auction' => $auction]);
    }

    public function show(Auction $auction,$id,$name)
    {
        $item=Auction::with('product.category','bids')->whereId($id)->first();

        return view('site.pages.product.productDetails',['item'=>$item]);
    }



    public function edit(Auction $auction)
    {

        $product=Product::select('products.name','products.id')->get();
        return view('admin/pages/auction/edit',['auction'=>$auction,'products'=>$product]);

    }


    public function update(AuctionRequest $request, $id)
    {
        $auction = Auction::with('medias','slots')->whereId($id)->select();
        $auction->first()->update($request->except('files','images','duration_time','slot_number', 'deleted_images'));
        $this->removeSlot($auction->first());
        $this->addSlot($request, $auction->first());

        foreach ($auction->first()->medias as $media) {
            if(!in_array($media->id, $request->input('deleted_images')?:[])){
                $this->removeImage($media);
            }
        }
        $this->addImage($request, $auction->first());
        return redirect('/admin/auction')
            ->with(['type'=>'success','message'=>'Auction updated Successfully']);
    }

    public function destroy(Auction $auction)
    {
        $bidCount = Bid::whereAuctionId($auction->id)->count();
        $autoBidCount = AutoBid::whereAuctionId($auction->id)->count();
        $totalCount =$bidCount + $autoBidCount;
        if($totalCount){
            return back()
                ->with([
                    'type'=>'error',
                    'message'=> "You have already ".$totalCount." 
                    bid or auto bid with this Auction. Please delete bid or auto bid first."]);
        } else {
            $this->removeSlot($auction);
            foreach ($auction->medias as $media) {
                $this->removeImage($media);
            }
            $auction->delete();
            return back()
                ->with(['type'=>'success','message'=>'Auction deleted successfully']);
        }
    }
    private function removeSlot($auction) {
        $auctionSlot = AuctionSlot::whereAuctionId($auction->id)->select('id');
        $auctionSlot->whereIn('id', $auctionSlot->get())->delete();

    }
    public function removeImage($media){
        Storage::disk('public')->delete($media->image);
        $mediaItem = AuctionMedias::find($media->id);
        $mediaItem->delete();
    }

    private function addImage($request, $auction) {
        if($request->file('images')){
            foreach ($request->images as $key=>$item){
                $extension = $item->getClientOriginalExtension();
                $name='auction/'.$key.time().'.'.$extension;
                Storage::disk('public')->put($name,  File::get($item));
                AuctionMedias::create(['auction_id'=>$auction->id, 'image'=>$name]);
            }
        }
    }

    private function addSlot($request, $auction) {
        $slotNumber = $request->input('slot_number');
        $durationTime = $request->input('duration_time');

        if ($slotNumber[0]) {
            for($i=0; $i<count($slotNumber);$i++){
                AuctionSlot::create([
                    'auction_id'=>$auction->id,
                    'slot_number'=>$slotNumber[$i],
                    'duration_time'=>$durationTime[$i],
                ]);
            }
        }
    }

    public function updateStatus(Request $request){
            $auction = Auction::whereId($request->id);
            $auction->update([
                'is_closed'=>1,
                'status'=>'Inactive'
            ]);
            $user=User::find(1);
            event(new BidUpdate($user,$request->id));
            return response()->json([
               'closed'=>true
            ]);
    }
    public function fireEvent(Request $request, $id){
        $user=User::find(1);
        event(new BidUpdate($user, $id));
        return response()->json([
            'live'=>true
        ]);
    }


    public function getAuctionData(Request $request){

        $auctionList=Auction::with('product.category','medias','slots','bids.user')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();
        $ids=[];
        foreach ($auctionList as $auction){
            $ids[]=$auction->id;
        }
        $serverTime = Carbon::now()->format('Y-m-d H:i:s');
        $autoBidByUser = AutoBid::whereIn('auction_id',$ids)->get();
        return response()->json([
            'auctions'=>$auctionList,
            'serverTime'=>$serverTime,
            'autoBidByUser'=>$autoBidByUser,
        ]);

    }
    public function getSingleAuctionData(Request $request,$id){

        $auctionList=Auction::with('product.category','medias','slots','bids.user')
            ->find($id);

        $serverTime = Carbon::now()->format('Y-m-d H:i:s');
        $autoBidByUser = AutoBid::where('auction_id',$id)->get();
        return response()->json([
            'auctions'=>$auctionList,
            'serverTime'=>$serverTime,
            'autoBidByUser'=>$autoBidByUser,
        ]);

    }

}