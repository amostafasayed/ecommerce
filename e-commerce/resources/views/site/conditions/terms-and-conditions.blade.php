@extends('site.app')
@section('title-meta')
    <title>Terms & Condition</title>
@endsection

@section('content')
    @if(auth()->user())
    @include('.site.login.login-partitial.header')
    @endif
    <div class="container bg-white security">
        <div class="row p-5">
            <h1>Terms &amp; Conditions</h1>
            <hr class="w-100">
            <div class="content-block">
                <h2>General / Overview</h2>
                <p>The following Terms &amp; Conditions shall apply to the relationship between QuiBids Holdings LLC, all subsidiaries of QuiBids Holdings LLC, and www.quibids.com ("QuiBids"), and the end user ("You" or "Your"). By using QuiBids' services, You accept these Terms &amp; Conditions, as well as the manner in which QuiBids operates. These Terms &amp; Conditions constitute the entire agreement between QuiBids and You and supersede and replace all prior commitments, undertakings or representations, whether written or oral, between You and QuiBids with respect of Your use of QuiBids.</p>
                <p>Information on QuiBids, such as the "QuiBids 101", "Help" or "About Us" sections, are only recommendations and are not intended as rules or guidelines. QuiBids is not liable or responsible for the actions of users or other individuals who have read or been informed of such information or other written material.</p>
                <p>As is typical with auctions, QuiBids cannot guarantee that You will be the winner of any individual auction or that the final price in any auction will be a tremendous discount. Sometimes bidding can be very competitive, and the competition tends to grow as the products become more valuable or sought after.</p>
                <p>In order to give You a sense of what Your competition might be, below is a chart that shows how many bidders participated historically in certain auctions and about how many bids the winner of the auction placed.</p>
                <table class="table table-striped">
                    <tbody><tr>
                        <th>Retail Cost<br>of Merchandise</th>
                        <th>Average Number<br>of Bidders</th>
                        <th>Average Number of Bids<br>Placed by Highest Bidder</th>
                    </tr>
                    <tr>
                        <td>$0 - $100</td>
                        <td>5.9</td>
                        <td>14.9</td>
                    </tr>
                    <tr>
                        <td>$100 - $500</td>
                        <td>25.8</td>
                        <td>66.3</td>
                    </tr>
                    <tr>
                        <td>$500 - $1000</td>
                        <td>88.8</td>
                        <td>180.4</td>
                    </tr>
                    <tr>
                        <td>Over $1000</td>
                        <td>186.3</td>
                        <td>296.9</td>
                    </tr>
                    </tbody></table>
                <br>
                <p>If you have any questions, concerns, or comments about our Terms &amp; Conditions, please email us at <strong>firebidder.com</strong>.</p>
            </div>

            <div class="content-block">
                <h2>Acceptance of Terms &amp; Conditions</h2>

                <p>If You do not agree to the Terms &amp; Conditions, do not use QuiBids. If You access, use, or download in any way any service from QuiBids, You agree to and are bound by these Terms &amp; Conditions and also acknowledge that (a) You have had the opportunity to review the tutorials regarding the use of QuiBids included in <a href="http://www.quibids.com/quibids101/">"QuiBids 101"</a>, (b) You have either reviewed the tutorials or have chosen not to do so, and (c) You have had the opportunity to ask questions regarding the use of QuiBids by telephone or email and to have those questions answered.</p>
            </div>

            <div class="content-block">
                <h2>Changes to Terms &amp; Conditions</h2>

                <p>QuiBids may change (add to, delete, or amend) the Terms &amp; Conditions from time to time, with or without cause.  Should this occur, You agree that QuiBids may provide You notice of such changes in any of the following ways: via an email from QuiBids, via an RSS feed, via <a href="http://blog.quibids.com">QuiBids' blog</a>, and/or by posting a change notice on the website for a reasonably limited time.  It is Your responsibility to review any revised Terms &amp; Conditions.  Should You find any subsequent revisions to the Terms &amp; Conditions unacceptable, You must cease using QuiBids' services.  By continuing to access, use, or download in any way any service from QuiBids following notice of a revision to the Terms &amp; Conditions, You agree to and are bound by the Terms &amp; Conditions as revised.</p>
            </div>

            <div class="content-block">
                <h2>Eligibility</h2>

                <p>By accepting the Terms &amp; Conditions and/or registering with QuiBids, You confirm that You are at least 18 years of age and at least age of majority under applicable laws of the country, state, city, or other jurisdiction (each, a "Jurisdiction") of Your residence, that You can engage in a binding contract, and that You meet all other eligibility requirements contained in these Terms &amp; Conditions. By using QuiBids, You warrant that You have the right, authority, and capacity to enter into this agreement and to abide by all of the Terms &amp; Conditions.</p>
                <p>You must reside in one of the 50 states of the United States or Washington D.C.</p>
                <p><strong>QuiBids employees and their family members (defined as parents, spouse, siblings and children) and any persons residing in the same household as QuiBids employees may not under any circumstances participate in QuiBids auctions.</strong></p>
                <p>QuiBids products and services are offered exclusively to private users and not to commercial or semi-commercial retailers.</p>
                <p>QuiBids reserves the right to limit in its sole discretion the number of user accounts per natural person and the number of won auctions per user account. A single credit card may not be used in conjunction with multiple user accounts. QuiBids limits the number of user accounts per natural person to one (exceptions may apply – contact customer support with any questions at firebidder.com). A single user account may win a maximum of twelve (12) auctions, excluding bid voucher auctions, in a 28-day period. A single user account may only win a maximum of twelve (12) auctions per 24-hour period.  A user account may only be winning a maximum of five (5) auctions at any one time, plus one (1) beginner auction if applicable, less the number of current auction wins over the previous 24-hour period. A user account generally may win only one of the same item with a value price greater than $285 in value during a 28-day period and /or one item with a value price equal to or greater than $1,000 during a 28-dayperiod.  However, QuiBids reserves the right to, from time to time and in its sole discretion, impose different win limits for specific products.</p>
                <p>You may not participate in collusion with other users.  QuiBids reserves the right to permanently close the accounts of users suspected of collusion. If Your account has been closed due to suspicion of collusion, You will no longer be entitled to refunds for Your purchases on QuiBids.</p>
            </div>

            <div class="content-block">
                <h2>Registering</h2>

                <p>You may register only once with QuiBids, and You must provide a postal address where You reside (P.O. boxes or similar arrangements are not permitted). You agree not to have more than one account. You must not provide misleading information when registering. You may not collude to exchange information with other QuiBids users. Your chosen username must not be offensive, rude, disparaging, or intended to deceive or delude other QuiBids users. Your username may not advertise for other websites or services or otherwise violate the intellectual property rights of any third party.</p>
                <p>If QuiBids receives information that Your username is illegal or in breach of these Terms &amp; Conditions as evaluated in QuiBids' sole discretion, Your user account may be frozen until You change the username. QuiBids also may permanently close Your account without prior notice to You for violating these Terms &amp; Conditions.</p>
                <p>You are responsible for keeping Your user account password confidential. <strong>QuiBids will never ask for Your password except during login. You should never provide Your password to anyone, including QuiBids' employees</strong>. User accounts are non-transferable. Only You may use Your user account. You agree to be liable for all offensive or unlawful activities that are undertaken using Your user account.</p>
            </div>

            <div class="content-block">
                <h2>Referrals</h2>

                <p>You may refer friends to QuiBids using the referral form on the QuiBids website. QuiBids offers free bids to any user who refers new users who purchase a Bid Pack. QuiBids reserves the right to review each referral for possible fraud. You may not refer family members or persons located in Your household. Any abuse of the referral system may result in the deduction of fraudulent bids awarded and/or the termination of Your account in QuiBids' sole discretion.</p>
            </div>

            <div class="content-block">
                <h2>Account Termination</h2>

                <p>QuiBids reserves the right to temporarily or permanently terminate Your account at QuiBids sole discretion if it determines or suspects You have violated these Terms &amp; Conditions, any laws, or the rights of our other users or other third parties. Examples of unauthorized usage include, but are not limited to, <strong>the use of unauthorized third-party bidding or bid tracking software, the creation of multiple accounts by the same individual or other fraudulent account activity or behavior</strong>. You agree that if QuiBids, in good faith and in its sole discretion, determines that You have breached these Terms &amp; Conditions, QuiBids may withhold, cancel, or otherwise retain any and all of Your pending deliveries and/or refunds for bids.</p>
            </div>

            <div class="content-block">
                <h2>Bid Purchases / Bidding / Bid-O-Matic</h2>

                <p>Bids are purchased in advance in the form of "Bid Packs." QuiBids reserves the right to offer different size Bid Packs at different times.  Should You not honor a payment, You will be charged a returned payment fee. QuiBids reserves the right to block access to a user's account until payment in full of the invoice amount, including any fees due to returned payment, etc., and to withhold any outstanding deliveries until payment in full is received.</p>
                <p>From time to time, free bids may be offered. Free bids are only valid until the expiration date stated in the promotion, which is typically seven days. Once a bid is placed in an auction, it is deducted from the user's bid account and can no longer be refunded, irrespective of whether or not the bid is successful.</p>
                <p>You can place bids in two ways: (1) manually by clicking an auction's "Bid" button and/or (2) by using the Bid-O-Matic function. Bid-O-Matic is an automated feature which lets You bid on an auction even when You are not online or logged in. Bid-O-Matic automatically places bids according to Your instructions. You can read more about how the Bid-O-Matic operates in the "QuiBids 101" and "Help" sections.</p>
                <p>A maximum of 20 seconds will be added to the timer and one bid will be deducted from Your account with each bid placed. An auction ends when the timer on the QuiBids server(s) hits zero. The winner of an auction is the last bidder the database recorded before the timer on the QuiBids server(s) hit zero.</p>
                <p>Bids are a limited license to participate in QuiBids auctions and have no monetary value.  You may not obtain any money in exchange for Bids; however, QuiBids has a limited return policy with respect to purchased Bid Packs.  For nine months after purchasing a Bid Pack, You have the right to a full refund for the purchase price of the unused bids remaining in the Bid Pack.  Voucher and Free Bids are not eligible for a refund.  To the extent there are unused Bids in Your account, and there has been no activity for two years, You will be charged an inactivity fee of five (5) Bids per month for each inactive Bid Pack.  All Bids expire after three years of inactivity.  Once we delete Bids we will not reinstate them, except at our discretion.</p>
                <p>When You place Bids, the first Bids used will be Bids from Bid Packs, starting with the Bids that are going to expire the soonest.  After Bids from Bid Packs are exhausted, Free Bids will be used, starting with the Bids that are closest to expiring.  After Free Bids are exhausted, Voucher Bids are used, starting with the Bids that are closest to expiring.  At QuiBids sole discretion, You may be given an opportunity to select which type of bids to use on an auction.</p>
                <p>If You ever believe that Your account does not reflect Bids that You have acquired validly, You must notify us within six months of the date You claim to have acquired the Bids.</p>
                <p>If You did not win an auction, You may still purchase the item at our Value Price using the Buy Now feature.  You have two hours after an auction ends to utilize this feature.  Once You click the Buy Now button, You will receive credit for the cost of the Bids You placed in that particular auction toward the Value Price of the item You are purchasing.  Please note that You will not receive any credit for Voucher Bids, Free Bids, or bids that are more than nine months old with regard to the Buy Now feature.  You may not purchase an item through the Buy Now feature until You have purchased at least one bid pack and placed at least one bid on the auction for the item You want to purchase.  You can read more about Buy Now in the "QuiBids 101" sections.</p>
                <p>QuiBids attempts to limit some auctions to users of comparable skill, as determined by QuiBids, to enhance user experience and maintain a viable business model.  In so doing, QuiBids may limit which auctions are available to particular users based on any factors deemed appropriate by QuiBids in its sole discretion, including experience of the user, historical success of the user, demographic factors, prior bidding and spending activity, and other factors.  In particular, QuiBids may limit certain auctions to less experienced or successful users in any manner QuiBids deems appropriate to optimize the overall user experience of all QuiBids users.  You acknowledge that You may be, and You consent to being, excluded from auctions at QuiBids discretion.  </p>
                <p>QuiBids may allow users in multiple countries to participate in a single auction. QuiBids offers these auctions through a group of affiliates located in each country in which QuiBids operates. By participating in these auctions, You agree that you are participating in them solely through the QuiBids affiliate located in Your country. Although users participating in auctions are participating in a single auction, the actual item offered and bid upon, and the price at which such item is offered and bid upon, may vary based on the country in which the user is located. Although QuiBids strives to offer identical or similar items to all users participating in a single auction at an identical or similar price, manufacturers' practices, product availability, currency exchange rates, and other factors make this impractical in some circumstances. By participating in an auction, You agree that QuiBids may offer a different but similar (as determined by QuiBids in its sole discretion) item at a different but similar (as determined by QuiBids in its sole discretion) price to users located in other countries participating in the same auction.</p>
                <p>QuiBids may, in its sole discretion, offer auctions that allow users to choose the product they want from a specified list of products after they win an auction or choose to Buy Now.  Although QuiBids strives to offer products in an auction that are of an identical or similar price, manufacturers' practices, product availability, currency exchange rates and other factors make this impractical in some circumstances.  By participating in auctions, you agree that QuiBids may, in its sole discretion, offer different products at different but similar (as determined by QuiBids in its sole discretion) prices.</p>
                <p>QuiBids reserves the right to, from time to time, in its sole discretion, change the price of bids.</p>
                <p>QuiBids has a feature called "Locked Auctions".  At some point during each auction, at QuiBids' sole discretion, the auction will be locked and customers who have not placed bids on the auction will not be allowed to do so.  Also, customers who have not placed bids on the auction within a certain period of time or have not placed a minimum number of bids, as determined by QuiBids' sole discretion, will be prevented from placing further bids.  Customers who have been "locked out" will still be allowed to utilize the Buy Now feature.</p>
            </div>

            <div class="content-block">
                <h2>QuiBids Store</h2>
                <p>QuiBids may in its sole discretion offer select products for direct purchase through the QuiBids Store.  QuiBids reserves the right in its sole discretion to limit the number of products per user that may be purchased through the QuiBids Store.  Products offered through the QuiBids Store are brand-new, unless specifically stated.</p>
                <p>Voucher Bids may be given to users who purchase items from the QuiBids Store. The number of bids given with each purchase may vary based upon QuiBids' sole discretion.  If a product purchased through the QuiBids Store is returned, the Voucher Bids received with the purchase will be deducted from the user's account.  If there are fewer Voucher Bids remaining in the account than were received with the purchase, the remaining Voucher Bids will be forfeited and an amount equal to the number of Voucher Bids used multiplied by $0.40 will be deducted from the amount refunded otherwise.</p>
            </div>


            <div class="content-block">
                <h2>Odds of Winning Auctions</h2>

                <p>Every auction is unique and the results of all auctions offered on QuiBids depend on the number of users participating in such auctions and the skill of the users participating in the auctions; precise odds of winning are therefore unavailable.</p>
            </div>

            <div class="content-block">
                <h2>Acceptance of the Win / Payment</h2>

                <p>After an auction has ended, You must actively confirm and pay the total price for the won auction. Once You have clicked on the confirmation button the win is accepted. If an auction win has not been confirmed and paid within three (3) days of the auction end date, QuiBids may withdraw the offer to conclude the order and permanently revoke the winner's right to pay for and receive delivery of an item. If QuiBids does this, all bids placed in that auction will be deemed expired and will be non-refundable. After confirming the win and paying the total amount due, the winner will receive a confirmation e-mail. The item will not be sent to You until the total price has been paid to QuiBids. An invoice containing the auction price and shipping costs will be sent to You by QuiBids once delivery has been arranged.</p>
                <p>With respect to items sold by QuiBids, we cannot confirm the price of an item until You order. Despite our best efforts, a small number of the items in our catalog may be mispriced. If the correct price of an item sold by QuiBids is higher than our stated price, we will, at our discretion, either contact you for instructions before shipping or cancel your order and notify You of such cancellation. Other merchants may follow different policies in the event of a mispriced item.</p>
            </div>

            <div class="content-block">
                <h2>Special Promotions</h2>

                <p>Any special promotions run by QuiBids shall only be valid if they are announced on QuiBids or in its corresponding QuiBids Special Offers email. Certain promotions may only be valid for a limited time, with details announced on QuiBids or in our QuiBids Special Offers. Once the advertised time limit of any promotion has been reached, or the relevant auction or auctions have ended, the promotion is also finished.</p>
            </div>

            <div class="content-block">
                <h2>Reviews and Comments</h2>

                <p>You may post reviews and/or comments, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political messages, commercial solicitation, chain letters, mass mailings, or any other form of "spam." You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of any content You post. QuiBids reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content. QuiBids also reserves the right to prohibit You from posting additional comments.</p>
                <p>If You do post content, and unless we indicate otherwise, You grant QuiBids a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant QuiBids and its affiliates the right to use the name that You submit in connection with such content. You represent and warrant that You own or otherwise control all of the rights to the content that You post; that the content is accurate; that use of the content You supply does not violate this policy and will not cause injury to any person or entity; and that You will indemnify QuiBids for all claims resulting from content You supply. QuiBids has the right but not the obligation to monitor and edit or remove any activity or content. QuiBids takes no responsibility and assumes no liability for any content posted by a user.</p>
            </div>

            <div class="content-block">
                <h2>Returns / Cancellations</h2>

                <p>QuiBids allows customers the right to cancel or return an order in accordance with&nbsp;<a href="http://www.quibids.com/help/faq/11-What-is-the-return-policy#35">QuiBids Returns Policy</a>, which QuiBids may change from time to time in QuiBids sole discretion. If You cancel an order before it is processed, You will be entitled to a refund of the transaction amount (including shipping costs if no items have been shipped) You have paid even if the goods are not defective in any way. Bids placed on the auction are not eligible for a refund.</p>
                <p>Some exceptions may apply. If an exception does apply, it will be noted on the product page. Exclusions include Free Bids, Coupons, and Voucher Bids. If You are found to be in bad standing due to fraudulent behavior, excessive refund requests, or other such behavior, You are deemed to be in breach of the Terms &amp; Conditions and will not be eligible for a refund.</p>
                <p>If You wish to return or cancel an order, please contact us at <strong>firebidder.com</strong>.</p>
                <p>In order to complete a return, You must return the received product or products in new condition. Shipping expenses for returns will be paid by You unless the reason for the return is QuiBids’ error. QuiBids will not accept a return if You are unable to return the product received or are only able to return it in part or in a damaged or used condition.  QuiBids reserves the right, in its sole discretion, to charge a restocking fee equal to 10% of the value of the item.</p>
                <p>Should QuiBids incur additional costs for insufficient postage on the return, these costs will be deducted from the refund amount QuiBids will remit to You.</p>
                <p>Should QuiBids not be able to deliver the product ordered or the product won for any reason, You will have the option to accept an alternative but comparable item, as determined by QuiBids in its sole discretion, or receive a refund of the transaction amount paid (including shipping costs, if any). Any bids used in that specific auction will also be credited back to your account.</p>
            </div>

            <div class="content-block">
                <h2>Delivery</h2>
                <p><strong>Deliveries are made exclusively to the 50 states of the United States and Washington D.C.. Some restrictions or higher shipping costs may apply to deliveries to Alaska and Hawaii</strong>. Unless otherwise stated, delivery will be made directly from our supplier or from our warehouse to the address provided by You. Delivery times vary; therefore, any time provided is only a guide. QuiBids shall be entitled to involve third parties to satisfy its contractual obligations without being required to notify the buyer. Obvious damage to the item from transport or packaging damaged during transport must be reported to QuiBids upon receipt.</p>
                <p>QuiBids reserves the right, in its sole discretion, to refuse shipment to outlying islands and territories. If You are a resident of an outlying island or territory and QuiBids determines Your purchases cannot be shipped, QuiBids will refund the purchase price of the items, including bids placed on those items.</p>
            </div>
            <div class="content-block">
                <h2>Withholding Payment / Retention of Title</h2>

                <p>You agree that the item delivered shall remain QuiBids' property until QuiBids receives payment in full, including shipping costs and bids used in the auction.</p>
            </div>
            <div class="content-block">
                <h2>Disclaimer of Warranty and Liability Regarding Use of QuiBids</h2>

                <p>You agree that use of QuiBids is at Your sole risk. Neither QuiBids nor any of its officers, directors, employees, agents, merchants, sponsors, licensors, component suppliers (both hardware and software), or any third party who provides products or services purchased from or distributed by QuiBids, or the like, warrant that websites affiliated with QuiBids, including, but not limited to, QuiBids, will be uninterrupted, error-free, or free of viruses, worms, trojan horses, keyboard loggers, spyware, adware, malware, harmful or malicious code, or other defects. The information, products, and services published on QuiBids may contain inaccuracies or typographical errors. QuiBids makes no warranty as to the results that may be obtained from the use of QuiBids or as to the accuracy, reliability, or currency of any information content, service, or merchandise provided through QuiBids. QuiBids shall not be responsible for any opinions, views, advice, or statements posted on QuiBids (including, without limitation, in any public posting areas of the website) by any person or entity other than an authorized QuiBids spokesperson. Advertisers, content providers, users, guests, independent writers, and experts are not authorized QuiBids spokespersons. At no time should the opinions, views, advice, or statements provided by advertisers, content providers, users, guests, independent writers, or experts be relied upon for important personal decisions without independent verification.</p>
                <p>YOUR USE OF QUIBIDS IS AT YOUR SOLE RISK. THIS WEBSITE, INCLUDING THE SERVICE AND SOFTWARE, IS PROVIDED BY QUIBIDS LLC ON AN "AS IS" AND "AS AVAILABLE" BASIS. TO THE FULLEST EXTENT PERMISSIBLE BY APPLICABLE LAW, QUIBIDS DISCLAIMS ALL IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, IMPLIED AND STATUTORY WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.</p>
                <p>QUIBIDS MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF QUIBIDS, SECURITY OF THE WEBSITE, THE RESULTS THAT MAY BE OBTAINED FROM USE OF QUIBIDS, THE AVAILABILITY OF ANY GOODS OR SERVICES OFFERED ON OR THROUGH THE WEBSITE, INCLUDING E-MAIL, OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON THE WEBSITE. WITHOUT LIMITING THE FOREGOING, QUIBIDS DOES NOT WARRANT THAT THE MATERIALS ARE ACCURATE, RELIABLE OR CORRECT, THAT THE SITE WILL MEET YOUR REQUIREMENTS, THAT THE SITE WILL BE AVAILABLE AT ANY PARTICULAR TIME OR LOCATION, UNINTERRUPTED OR SECURE, THAT ANY DEFECTS OR ERRORS WILL BE CORRECTED, OR THAT THE MATERIALS ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. ANY SERVICE OR SOFTWARE DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE WEBSITE IS DONE AT YOUR OWN DISCRETION AND RISK, AND YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD  OR INSTALLATION OF ANY SUCH MATERIAL. SOME STATES OR OTHER JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES, SO THE ABOVE EXCLUSIONS MAY NOT APPLY TO YOU.</p>
                <p>NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THE WEBSITE OR SERVICE SHALL CREATE ANY WARRANTY NOT EXPRESSLY STATED IN THESE TERMS &amp; CONDITIONS.</p>
                <p>YOU EXPRESSLY UNDERSTAND AND AGREE THAT QUIBIDS WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF OR INABILITY TO USE THE WEBSITE, SOFTWARE, OR ANY RELATED SERVICES, INCLUDING, BUT NOT LIMITED TO, DIRECT, INDIRECT, INCIDENTAL, CONSEQUENTIAL, SPECIAL, EXEMPLARY, AND PUNITIVE DAMAGES, WHETHER SUCH CLAIM IS BASED ON WARRANTY, CONTRACT, TORT (INCLUDING NEGLIGENCE), OR OTHERWISE, (EVEN IF PROVIDER HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES).</p>
                <p>THE LIMITATIONS OF THIS SECTION SHALL APPLY NOTWITHSTANDING ANY RELIANCE ON ANY INFORMATION OBTAINED FROM QUIBIDS OR THAT RESULTS FROM MISTAKES, OMISSIONS, INTERRUPTIONS, DELETION OF FILES OR E-MAIL, ERRORS, DEFECTS, VIRUSES OR OTHER MALICIOUS CODE, DELAYS IN OPERATION OR TRANSMISSION, OR ANY FAILURE OF PERFORMANCE, WHETHER OR NOT RESULTING FROM ACTS OF GOD, COMMUNICATIONS FAILURE, THEFT, DESTRUCTION, OR UNAUTHORIZED ACCESS TO PROVIDER RECORDS, PROGRAMS, OR SERVICES, AND WHETHER OR NOT QUIBIDS HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. USER HEREBY ACKNOWLEDGES THAT THIS LIMITATION SHALL APPLY TO ALL CONTENT, MERCHANDISE, AND SERVICES AVAILABLE THROUGH QUIBIDS.</p>
                <p>THIS LIMITATION OF LIABILITY SHALL APPLY WHETHER THE DAMAGES ARISE FROM ASSEMBLY, USE OR MISUSE OF OR RELIANCE ON QUIBIDS SERVICES OR ITEMS PURCHASED THROUGH QUIBIDS, FROM INABILITY TO USE QUIBIDS' SERVICES OR ITEMS PURCHASED THROUGH QUIBIDS, OR FROM THE INTERRUPTION, SUSPENSION, OR TERMINATION OF QUIBIDS' SERVICES (INCLUDING SUCH DAMAGES INCURRED BY THIRD PARTIES).</p>
                <p>SOME STATES OR OTHER JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATIONS AND EXCLUSIONS MAY NOT APPLY TO YOU.</p>
                <p>If You are dissatisfied with any portion of QuiBids, You should discontinue Your use of QuiBids.</p>

            </div>

            <div class="content-block">
                <h2>Disclaimer of Warranty and Liability Regarding Purchases from QuiBids</h2>

                <p>QuiBids hereby disclaims any and all liability from claims arising from trip packages offered on the QuiBids site. QuiBids will not be liable for any damages or injuries, whether physical or emotional, that occur or are received during a trip purchased on the QuiBids site. QuiBids is not liable for flight delays, loss of baggage, or other losses that occur during a trip offered on the QuiBids site.</p>
                <p>All new products are sold with the manufacturer's limited warranty only. QuiBids warrants solely that the products sold to You under these terms shall have the characteristics specified in QuiBids' specifications for such products as set forth in the description of each auction and assumes no further warranties. The warranty period and service varies by manufacturer and product. The full text of any such warranty is available, free of charge, upon written request to QuiBids. Warranty is excluded for the delivery of any used products.</p>
                <p>EXCEPT FOR THE WARRANTIES SET FORTH ABOVE, QUIBIDS MAKES NO OTHER WARRANTIES, EITHER EXPRESS OR IMPLIED, WITH RESPECT TO THE PRODUCTS, OR ANY RELATED SERVICES PERFORMED BY QUIBIDS OR ANY OF ITS AGENTS OR SUBCONTRACTORS IN CONNECTION WITH ANY ORDER, INCLUDING, WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.</p>
                <p>YOU AGREE THAT QUIBIDS SHALL NOT BE LIABLE FOR PERSONAL INJURY AND PROPERTY DAMAGE RESULTING FROM THE USE, IMPROPER HANDLING, MODIFICATION, OR MISUSE OF THE PRODUCTS BY YOU OR ANY OTHER PERSON FOLLOWING DELIVERY BY QUIBIDS. IN NO EVENT SHALL QUIBIDS BE LIABLE TO YOU OR ANY OTHER PERSON FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES INCLUDING, BUT NOT LIMITED TO, LOSS OF PROFITS OR GOODWILL, LOSS-OF-USE DAMAGES OR ADDITIONAL EXPENSES INCURRED, WHETHER PURSUANT TO A CLAIM IN CONTRACT, TORT OR OTHERWISE, AND WHETHER IN AN ACTION FOR BREACH OF WARRANTY OR OTHERWISE.</p>
            </div>

            <div class="content-block">
                <h2>Indemnity</h2>

                <p>You agree to indemnify, defend, and hold QuiBids and its members, managers, shareholders, directors, officers, employees, agents, affiliates, licensors, and other partners (collectively, the "Indemnified Persons") harmless from any loss, cost, expense, liability, claim, or demand, including reasonable attorneys' fees, suffered by any Indemnified Persons due to, arising out of, or in connection with (i) Your use of QuiBids or any of the services offered by QuiBids, (ii) any violation of these Terms &amp; Conditions by You or any person acting in collusion with You, (iii) any violation of applicable law or court order by You, and (iv) any negligence or willful misconduct by You.</p>
            </div>

            <div class="content-block">
                <h2>System Outage / Temporarily Paused Auctions</h2>

                <p>A system outage has occurred if no bids can be submitted for items due to an unforeseeable disruption in a system. In such a case, auctions will be temporarily paused and the remaining time for the auctions, the current bidding price, and the current highest bidder will be recorded. After the disruption has been resolved, the auctions will be continued and ten minutes will be added to the remaining times for the auctions. Temporarily paused auctions are clearly indicated. Bids placed on a temporarily paused auctions will be credited back to Your account; however, QuiBids is not responsible for any other costs incurred by You due to a system outage. QuiBids reserves the right to cancel auctions that end due to system error, bot bidders, employee bidders, technical problems, or any other reasonable reason.</p>
                <p>With current technology, it is not possible to develop and operate computer programs (software) and data processing systems (hardware) entirely without error, or to rule out any unpredictable events in connection with the Internet. QuiBids, therefore, provides no guarantee for the constant and uninterrupted availability of the website and other technical systems. QuiBids shall not be liable for any damage incurred by auction users or third parties from using QuiBids' services. In particular, QuiBids shall not be liable for damage that occurs due to bids not being received by QuiBids, not being received promptly, or not being considered as a consequence of technical errors.</p>
            </div>

            <div class="content-block">
                <h2>Trademarks</h2>

                <p>QuiBids' logos are trademarks of QuiBids. All rights reserved. Any trademarks appearing on QuiBids are the property of their respective owners.</p>
            </div>

            <div class="content-block">
                <h2>Service and Support for Products Purchased</h2>
                <p>All requests for technical service and support on products purchased on QuiBids should be made directly to the manufacturer in accordance with their Terms &amp; Conditions.</p>
            </div>

            <div class="content-block">
                <h2>Dispute Resolution</h2>
                <p>By agreeing to these Terms &amp; Conditions, You and QuiBids each waive the right to a jury trial or to participate in a class action.  Further, You agree that any and all disputes, claims, and causes of action relating in any way to Your use of QuiBids, including Your use prior to agreeing to these Terms &amp; Conditions, or to any products sold by QuiBids will be resolved by binding arbitration, rather than in court, except that You may assert claims in small claims court if Your claims qualify.</p>
                <p>You agree that any and all claims, disputes, and causes of action between You and QuiBids, including those relating to Your use of the QuiBids website or these Terms &amp; Conditions (each a "Dispute" and collectively, "Disputes"), shall be resolved as set forth in this section.  Before initiating any formal Dispute resolution proceedings, You agree to negotiate with QuiBids regarding any Disputes in good faith on an individual basis, and not as a plaintiff or class member in any purported class or representative proceeding.  You may initiate these negotiations by sending a notice of the Dispute (the "Notice of Dispute") to QuiBids in a manner specified in the "Notices" section below.  If QuiBids and You do not reach an agreement regarding a Dispute within 30 days following QuiBids' receipt of the Notice of Dispute, QuiBids and You agree to submit such Dispute to binding arbitration, on an individual basis, under the Commercial Arbitration Rules and the Supplementary Procedures for Consumer Related Disputes of the American Arbitration Association (the "AAA rules").  The AAA rules are available online at adr.org.  The proceedings shall be governed by the Federal Arbitration Act, and the award shall be final and binding, may be enforced in any court of competent jurisdiction, and shall not be subject to appeal.</p>
                <p>During the arbitration, the amount of any settlement offer made by QuiBids or You shall not be disclosed to the arbitrator until after the arbitrator determines the amount, if any, to which You or QuiBids is entitled.</p>
                <p>QuiBids will pay the arbitration filing fee for Disputes involving less than $75,000, unless the arbitrator determines the claims are frivolous.  If the arbitrator finds that Your claim is frivolous or brought for an improper purpose then the payment of all fees will be governed by the AAA rules.  In such case, You agree to reimburse QuiBids for all monies previously disbursed by QuiBids that are otherwise Your obligation to pay under the AAA rules.  In addition, if You initiate an arbitration in which you seek more than $75,000 in damages, the payment of these fees will be governed by the AAA rules.   For claims totaling less than $10,000, You may choose to have the arbitration conducted by telephone, based on written submissions, or in person.  Unless QuiBids and You agree otherwise, any arbitration hearings will take place in the county where you live.  Except as otherwise provided for herein, QuiBids will pay all AAA filing, administration, and arbitrator fees for any arbitration initiated in accordance with the notice requirements above.</p>
                <p>In the event of a finding in Your favor, QuiBids agrees to pay Your attorney, if any, and reimburse any expenses, including expert witness fees and costs that Your attorney reasonably accrues for investigating, preparing, and pursuing Your claim in arbitration.   If the arbitrator issues You an award that is greater than the value of QuiBids' last written settlement offer made before an arbitrator was selected then QuiBids will pay You the greater of the award or $10,000 and pay Your attorney twice the amount of attorney's fees and reimburse any reasonable expenses incurred by Your attorney related to Your representation.   This right to attorneys' fees and expenses supplements any right to attorneys' fees and expenses You may have under applicable law.  Thus, if You would be entitled to a larger amount under applicable law, this provision does not preclude the arbitrator from awarding You that amount.  However, You may not recover duplicative awards of attorneys' fees or costs.  Although under some laws QuiBids may have a right to an award of attorneys' fees and expenses if it prevails in arbitration, QuiBids agrees that it will not seek such an award.</p>
                <p>The arbitrator may award declaratory or injunctive relief only in favor of the individual party seeking relief and only to the extent necessary to provide relief warranted by that party's individual claim.  You and QuiBids agree that each may bring claims against the other only in Your or its individual capacity and not as a plaintiff or class member in any purported class or representative proceeding.  Further, unless both You and QuiBids agree otherwise, the arbitrator may not consolidate more than one person's claims, and may not otherwise preside over any form of a representative or class proceeding.  If this specific provision is found to be unenforceable, then the entirety of this arbitration provision shall be null and void.</p>
                <p>Notwithstanding any provision in this Agreement to the contrary, we agree that if QuiBids makes any future change to this arbitration provision (other than a change to the Address provided in the "Notices" section below) You may reject any such change by sending us written notice within 30 days of the change to the Address provided in the "Notices" section below.  By rejecting any future change, You are agreeing that You will arbitrate any dispute between us in accordance with the language of this provision.</p>

            </div>

            <div class="content-block">
                <h2>Applicable Law / Severability Clause</h2>

                <p>This Terms &amp; Conditions Agreement and Your use of QuiBids shall be governed by the laws of the United States of America and the State of Oklahoma.  Without in any way limiting the "Dispute Resolution" requirements set forth above, any court proceeding related to this website or these Terms &amp; Conditions may be brought only in a federal or state court sitting in Oklahoma.  You agree to accept the jurisdiction of such courts.</p>
                <p>QuiBids will follow all applicable laws for the sale of bid packages and goods in the countries in which it operates.</p>
                <p>VOID OUTSIDE OF THE UNITED STATES. VOID WHERE PROHIBITED OR RESTRICTED BY LAW. If You open an account or participate in auctions offered by QuiBids while located in a prohibited jurisdiction, You will be in violation of the law and these Terms &amp; Conditions and subject to having Your account suspended or closed permanently. You agree that QuiBids cannot be held liable if laws applicable to You restrict or prohibit Your participation.</p>
                <p>The UN Convention on the International Sale of Goods shall not apply.</p>
                <p>If any provision of these Terms &amp; Conditions is held by a court of competent jurisdiction to be invalid, unenforceable, or void, the remainder of these Terms &amp; Conditions shall remain in force and effect and such invalid, unenforceable or void provisions will be deemed to be modified so as to effect the original intent of these Terms &amp; Conditions as closely as possible.</p>
            </div>

            <div class="content-block">
                <h2>Protection of Data: Collection, Processing, and Use of our Customers' Personal Information</h2>

                <p>The protection of Your data is very important to us.  For more information on the collection, processing, and use of personal data, please read our <strong> Privacy Policy </strong>.</p>
            </div>

            <div class="content-block">
                <h2>External Links</h2>

                <p>Our website may contain links to other websites operated by third parties, and these sites may likewise contain links to other websites. These links are provided strictly for Your convenience and do not constitute an endorsement or approval of these websites. We assume no liability for the content of external links. The operators of the sites linked to and from this site are solely responsible for their contents. We cannot take any responsibility for the content, protection, or privacy guidelines of third-party websites.</p>
            </div>

            <div class="content-block">
                <h2>Waiver</h2>

                <p>Any waiver of any provision by QuiBids of the Terms &amp; Conditions or Privacy Policy will be effective only if in writing and signed by QuiBids.</p>
            </div>

            <div class="content-block">
                <h2>Note:</h2>

                <p>Placing bids online at www.QuiBids.com frequently or repeatedly can result in high costs to the user. All users should monitor their bidding practices and check their charges regularly.</p>
            </div>

            <div class="content-block">
                <h2>Notices</h2>

                <p>Except as provided otherwise in these Terms &amp; Conditions, all notices, requests, instructions, and other communications given to QuiBids by You must be given in writing by hand delivery in return for a receipt, sent certified or registered U.S. mail (return receipt requested), or sent by FedEx or a similar overnight courier service, addressed to QuiBids Holdings LLC, 4 NE 10th St, Suite 242, Oklahoma City, OK 73104-1402, or by email to  support@firebidder.com</p>
            </div>

        </div>

    </div>

@endsection



@section('scripts')
@endsection