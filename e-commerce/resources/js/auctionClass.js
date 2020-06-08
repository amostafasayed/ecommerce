import moment from 'moment';
import {AuctionJS} from './components/js/auction'

export class Auction {
    constructor(upTime, slots, id, isClosed, serverTime,
                costPerBid, price_increase_every_bid, starting_price, bids, usersBid,
                randomTen, randomId, ids) {
        this.slotRunningCount = 0,
            this.slots = slots,
            this.id = id,
            this.upTime = upTime,
            this.isClosed = isClosed,
            this.serverTime = serverTime,
            this.currentDiffTime = '',
            this.costPerBid = costPerBid,
            this.price_increase_every_bid = price_increase_every_bid,
            this.bids = bids,
            this.starting_price = starting_price,
            this.usersBid = usersBid,
            this.randomTen = randomTen,
            this.count = 0,
            this.randomId = randomId,
            this.ids = ids
        this.allSetTimouts=[]
    }

    startTimer() {
        var th = this
        var presentTime = $('#timer' + this.id).html()


        var timeArray = presentTime.split(/[:]+/)
        var h = this.sendBackTime(timeArray)[0]
        var m = this.sendBackTime(timeArray)[1]
        var s = this.sendBackTime(timeArray)[2]


        if (h == '00' && m == '-1' && s == '59') {

        }{
            $('#timer' + this.id).html(h + ":" + m + ":" + s);
        }


        if (h == '00' && m == '00' && s == '00') {
            this.closed()
            // this.slotRunningCount++
            // this.slotOver()
        } else {

          setTimeout(function () {

               th.startTimer()

            }.bind(this), 1000);

        }
    }

    setTimerWithBid(bids) {
        var totalSlotCount = 0;

        for (var as = 0; as < this.slots.length; as++) {
            totalSlotCount += this.slots[as].slot_number
        }

        var addedTime = bids.length ? bids[bids.length - 1].created_at : this.upTime
        var offLoop = false
        var totalSlotNumber = 0
        this.slotRunningCount = bids.length > 1 ? this.slotRunningCount = bids.length - 1 : 0

        for (var s = 0; s < this.slots.length; s++) {
            if (offLoop) {
                break;
            }
            var currentSlotNumber = this.slots[s].slot_number
            totalSlotNumber += currentSlotNumber
            var currentDurationTime = this.slots[s].duration_time

            if (this.slotRunningCount < totalSlotCount) {

                if (totalSlotNumber > this.slotRunningCount) {

                    var diffTime = this.diffTime(addedTime, this.serverTime)
                    var [diffHour, diffMinute, diffsec] = diffTime.split(':')
                    var timeDifference = Math.abs(parseInt(diffHour)) + ':' +
                        Math.abs(parseInt(diffMinute)) + ':' + Math.abs(parseInt(diffsec))
                    var currentMiliSecondsDiff = this.convertMiliSeconds(currentDurationTime) -
                        this.convertMiliSeconds(timeDifference)
                    if (Math.sign(currentMiliSecondsDiff) != -1) {
                        this.currentDiffTime = this.miliSecondsToTime(currentMiliSecondsDiff)
                    } else {
                        this.closed()
                    }
                    offLoop = true
                    break;

                } else {

                    if (this.slotRunningCount >= totalSlotCount) {
                        this.closed()
                    }

                }
            } else {
                this.closed()
            }


        }
    }

    setTimerWithServerTime() {

        var addedTime = this.upTime
        var offLoop = false

        for (var s = 0; s < this.slots.length; s++) {
            if (offLoop) {
                break;
            }
            var currentSlotNumber = this.slots[s].slot_number
            var currentDurationTime = this.slots[s].duration_time

            for (var sn = 0; sn < currentSlotNumber; sn++) {

                this.slotRunningCount++
                addedTime = this.addTime(addedTime, currentDurationTime)
                if (moment(addedTime).format('YYYY-MM-DD HH:mm:ss') >
                    moment(this.serverTime).format('YYYY-MM-DD HH:mm:ss')) {

                    var diffTime = this.diffTime(this.serverTime, addedTime)

                    var [diffHour, diffMinute, diffsec] = diffTime.split(':')
                    this.currentDiffTime = Math.abs(parseInt(diffHour)) + ':' +
                        Math.abs(parseInt(diffMinute)) + ':' + Math.abs(parseInt(diffsec))
                    offLoop = true
                    break;

                } else {
                    var totalSlotCount = 0;
                    for (var as = 0; as < this.slots.length; as++) {
                        totalSlotCount += this.slots[as].slot_number
                    }
                    if (this.slotRunningCount >= totalSlotCount) {
                        this.closed()
                    }

                }
            }
        }
    }

    sendBackTime(timeArray) {
        var h = this.addZero(timeArray[0], 'hrs');
        var m = this.addZero(timeArray[1]);
        var s = this.addZero((timeArray[2] - 1));
        if (s == 59) {

            if (m == '00' && h > 0 && m != 59) {
                m = 59
            } else {
                m = m - 1
                m = m.toString().length == 1 ? '0' + m : m
            }


        }

        if (m == 59 && s == 59) {
            if (h > 0) {
                h = h - 1
                h = h.toString().length == 1 ? '0' + h : h
            }

        }

        return [h, m, s]
    }

    addZero(time, hrs = null) {
        var timeLen = time.toString().length
        if (time < 10 && time >= 0 && timeLen == 1) {
            time = '0' + time
        }
        if (!hrs) {
            if (time < 0) {
                time = "59"
            }
        }
        return time
    }

    closed() {
        if (!this.isClosed) {
            axios.post('/auction/update-status', {
                id: this.id
            }).then(res => {
                if (res.data.closed) {
                    // $('#liveClose'+this.id).html('Closed')
                    // $('#hideBidOption'+this.id).css('display','none')
                    console.log('done')
                }
            })
        }
    }

    addTime(addWith, duration) {
        var [slotHour, slotMinute, slotsec] = duration.split(':')
        addWith = moment(addWith).add(slotHour, 'hours')
        addWith = moment(addWith).add(slotMinute, 'minutes')
        addWith = moment(addWith).add(slotsec, 'seconds')
        return addWith
    }

    diffTime(fromTime, toTime) {
        var a = moment(fromTime, "YYYY-MM-DD HH:mm:ss")
        var b = moment(toTime).format('YYYY-MM-DD HH:mm:ss')
        b = moment(b, "YYYY-MM-DD HH:mm:ss")

        var diffHour = a.diff(b, 'hours');
        var diffMinutes = a.diff(b, 'minutes');
        var diffSecconds = a.diff(b, 'second');

        var diffTimes = diffHour + ':' +
            parseInt(diffMinutes) % 60 + ':' +
            parseInt(diffSecconds) % 60
        return diffTimes
    }

    subTime(subWith, duration) {
        var [slotHour, slotMinute, slotsec] = duration.split(':')
        subWith = moment(subWith).add(slotHour, 'hours')
        subWith = moment(subWith).add(slotMinute, 'minutes')
        subWith = moment(subWith).add(slotsec, 'seconds')
        return subWith
    }


    convertMiliSeconds(data) {
        var [hrs, mins, secs] = data.split(':')
        return (parseInt(hrs * 60 * 60) + parseInt(mins * 60) + parseInt(secs)) * 1000
    }

    miliSecondsToTime(mili) {
        var miliSeconds = moment.duration(mili);
        var h = miliSeconds.hours();
        var m = miliSeconds.minutes();
        var s = miliSeconds.seconds();
        return h + ':' + m + ":" + s
    }

    slotOver() {
        var th = this
        var slotCount = 0;
        for (var i = 0; i < this.slots.length; i++) {
            slotCount += parseInt(this.slots[i].slot_number)
            if (slotCount > this.slotRunningCount) {
                setTimeout(function () {
                    $('#timer' + th.id).html(th.slots[i].duration_time);
                    setTimeout(function () {
                        th.startTimer()
                    }, 1000);

                }, 1000)
                break;

            } else {
                if (this.slots.length - 1 == i) {
                    this.slotFinished()
                }
            }

        }
    }

    slotFinished() {
        this.closed()
    }

    putAutoBid() {
        axios.post('/auto-bid-auto', {
            auction_id: this.id,
            random_user_id: this.randomId,
            all_user_ids: this.ids
        }).then(res => {

        })
    }

}




