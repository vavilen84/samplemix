$(document).ready(function () {
    var MixPageView = Backbone.View.extend({

        el: '.container',
        json: {},
        secondRatio: 10,
        milisecondRatio: 100,
        samplePlayList: {},
        samplePlayTimeouts: [],
        sampleSounds: [],
        stateStart: 1,
        stateStop: 2,
        milliseconds: 0,
        seconds: 0,
        minutes: 0,
        timerId: null,

        events: {
            'click #add-track': 'addTrack',
            'click .title button': 'addToActiveTrack',
            'click .remove': 'removeTrack',
            'click .track': 'setActiveTrack',
            'click .trash-icon': 'removeProperty',
            'click #start-stop': 'startStop',
            'click #reset': 'reset',
            'mousedown #track-pointer': 'pointerOnMouseDown',
            'mouseup #track-pointer': 'pointerOnMouseUp',
        },

        initialize: function () {
            this.setCollection();
            this.setActiveTrackByDefault();
            this.initTrackPointer();
        },

        initTrackPointer: function () {
            var self = this;
            $('#track-pointer').draggable({
                axis: "x",
                containment: "#track-pointer-wrapper",
                drag: function( event, ui ) {
                    self.setTimeDependingOnCursorPosition(ui.position.left)
                }
            });
        },

        setTimeDependingOnCursorPosition: function (position) {
            var self = this;
            var positionMiliseconds = position * self.milisecondRatio;
            if (positionMiliseconds < 1000) {
                var seconds = '00';
            } else {
                var seconds = Math.floor(positionMiliseconds / 1000);
                if (seconds > 59) {
                    seconds = seconds % 60;
                }
                if (seconds < 10) {
                    seconds = '0' + seconds;
                }
            }
            if (positionMiliseconds < 59900) {
                var minutes = '00';
            } else {
                var minutes = Math.floor(positionMiliseconds / 60000);
                if (minutes < 10) {
                    minutes = '0' + minutes;
                }
            }
            var miliseconds = positionMiliseconds % 1000;
            if (miliseconds < 100) {
                miliseconds += '0' + miliseconds;
            } else if (miliseconds < 10) {
                miliseconds += '00' + miliseconds;
            }
            $('#seconds').text(seconds);
            $('#miliseconds').text(miliseconds);
            $('#minutes').text(minutes);
        },

        getTimerMinutesFromMiliseconds: function (miliseconds) {
            var self = this;
            return
        },

        getTimerSecondsFromMiliseconds: function (miliseconds) {
            var self = this;
            var minutesMiliseconds = Math.ceil((miliseconds / self.second2pixelRatio) / 60);
        },

        setActiveTrack: function (e) {
            $('.track').removeClass('active');
            var curEl = $(e.currentTarget).addClass('active');
        },

        setActiveTrackByDefault: function () {
            $('.track').first().addClass('active');
        },

        setCollection: function () {
            var self = this;
            var collectionId = $('#current-collection').val();
            $.ajax({
                type: 'POST',
                data: {
                    collectionId: $('#current-collection').val()
                },
                url: Global.setCollection,
                success: function (response) {
                    if (response.samples.length) {
                        var samples = $('#samples');
                        var html = '';
                        response.samples.forEach(function (chunk, i, samples) {
                            var table = '<table class="collection-table">';
                            chunk.forEach(function (item, k, chunk) {
                                table +=
                                    '<tr>' +
                                    '<td class="title">' +
                                    '<button data-id="' + item.id + '" data-title="' + item.title + '" ' +
                                    'style="background:' + self.getRandomColor() + '" class="btn color-white">' +
                                    item.title +
                                    '</button>' +
                                    '</td>' +
                                    '<td class="audio">' +
                                    '<audio controls loop controlslist="nodownload">' +
                                    '<source src="/samples/mp3/' + item.id + '.mp3">' +
                                    '</audio>' +
                                    '</td>' +
                                    '</tr>';
                            });
                            table += '</table>';
                            html += table
                        });
                        samples.html(html);
                    }
                }
            });
        },

        getRandomColor: function () {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }

            return color;
        },

        addTrack: function () {
            var self = this;
            $('#tracks').append('<div class="track"><div class="controls">' +
                '<button class="remove confirm" type="button">R</button>' +
                '<button class="solo" type="button">S</button>' +
                '<button class="mute" type="button">M</button>' +
                '</div></div>');
        },

        removeTrack: function (e) {
            $(e.currentTarget).parents('.track').remove();
        },

        addSample: function (item, droppable) {
            var self = this;
            var trashIcon = "<i class='fa fa-times trash-icon'></i>";
            var id = item.attr('data-id');
            var audioTag = '<audio preload="auto" ><source src="/samples/mp3/' + id + '.mp3"></audio>';
            var el = $('<div class="dropped-sample"></div>')
                .css('background', item.css('background'))
                .attr('data-id', id)
                .attr('data-title', item.attr('data-title'))
                .append(trashIcon)
                .append(audioTag)
                .appendTo(droppable)
                .fadeIn()
                .draggable({axis: "x", containment: '.track'});

            var audio = el.find('audio');
            audio = audio[0];
            setTimeout(function () {
                el.css('width', audio.duration * self.secondRatio).attr('data-duration', audio.duration)
            }, 50);
        },

        getUniqueId: function () {
            return 'id_' + Math.random().toString(36).substr(2, 9);
        },

        addToActiveTrack: function (e) {
            var self = this;
            var track = $('.track.active');
            var curEl = $(e.currentTarget);
            if (track[0]) {
                self.addSample(curEl, track);
            }
        },

        startStop: function (e) {
            var self = this;
            var curEl = $(e.currentTarget);
            var state = curEl.attr('data-state');
            if (state == self.stateStart) {
                curEl.attr('data-state', self.stateStop);
                curEl.text('Stop ');
                self.start();
            } else {
                curEl.attr('data-state', self.stateStart);
                curEl.text('Start');
                self.stop();
            }
        },

        start: function (e) {
            var self = this;
            self.startAudioTracks();
            self.timerId = setInterval(counter, 10);
            function counter() {
                self.getTime();
                self.setTime();
                self.moveTrackPointer();
            }
        },

        moveTrackPointer: function () {
            var self = this;
            var pointer = $('#track-pointer');
            var position = pointer.css('left');
            var miliseconds = parseInt($('#miliseconds').text());
            var seconds = $('#seconds').text();
            var minutes = $('#minutes').text();
            var totalMiliseconds = miliseconds + self.second2milisecond(seconds) + self.minute2milisecond(minutes);
            pointer.css('left', (totalMiliseconds / self.milisecondRatio) + 'px');
        },

        second2milisecond: function (seconds) {
            return parseInt(seconds) * 1000;
        },

        minute2milisecond: function (minutes) {
            return parseInt(minutes) * 1000 * 60;
        },

        startAudioTracks: function () {
            var self = this;
            var tracks = $('#tracks').find('.track');
            $.each(tracks, function (index, value) {
                var samples = $(value).find('.dropped-sample');
                var durationCounter = 0;
                $.each(samples, function (k, v) {
                    var el = $(v);
                    var audio = $(v).find('audio');
                    var timeout = setTimeout(function () {
                        audio[0].play();
                    }, durationCounter * 1000);
                    durationCounter += audio[0].duration;
                    self.samplePlayTimeouts.push(timeout);
                    self.sampleSounds.push(audio[0]);
                });
            });
        },

        setTime: function () {
            var self = this;
            var miliseconds = self.milliseconds;
            if (miliseconds < 100) {
                miliseconds = '0' + miliseconds;
            }
            var seconds = self.seconds;
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            var minutes = self.minutes;
            if (minutes < 10) {
                minutes = '0' + minutes;
            }
            $('#miliseconds').html(miliseconds);
            $('#seconds').html(seconds);
            $('#minutes').html(minutes);
        },

        getTime: function () {
            var self = this;
            self.milliseconds += 10;
            if (self.milliseconds > 990) {
                self.milliseconds = 10;
                self.seconds++;
            }
            if (self.seconds > 59) {
                self.seconds = 0;
                self.minutes++;
            }
        },

        getTrackPointerPosition: function () {
            var self = this;
            return (self.oneHundredPercentPixel2milisecondRatio / self.pixel2milisecondRatio) * self.oneHundredPercentPixel2milisecondRatio;
        },

        /////////////////////////////////////////////////////////

        // recalculateSampleWidth: function () {
        //     var self = this;
        //     var samples = $('.dropped-sample');
        //     $.each(samples, function (index, value) {
        //         $(value).css('width', $(value).attr('data-duration') * self.second2pixelRatio);
        //     });
        // },
        //
        // pointerOnMouseDown: function (e) {
        //     var self = this;
        //     var curEl = $(e.currentTarget);
        //     clearInterval(self.timerId);
        //     var startButton = $('#start-stop');
        //     startButton.attr('data-state', self.stateStart);
        //     startButton.text('Start');
        // },
        //
        // pointerOnMouseUp: function (e) {
        //     var self = this;
        //     var curEl = $(e.currentTarget);
        //     curEl.attr('data-position', Math.floor(curEl.position().left));
        //     self.setTimerOnChangePointer();
        // },
        //
        // setTimerOnChangePointer: function () {
        //     var self = this;
        //     var pointer = $('#track-pointer');
        //     var position = Math.floor(pointer.position().left);
        //     self.milliseconds = Math.floor(position * self.pixel2milisecondRatio);
        //     self.seconds = Math.floor(self.milliseconds / 1000);
        //     self.minutes = Math.floor(seconds / 60);
        //     self.milliseconds -= self.seconds * 1000;
        //     if (isNaN(self.milliseconds)) {
        //         self.milliseconds = 0;
        //     }
        //     if (isNaN(self.seconds)) {
        //         self.seconds = 0;
        //     }
        //     if (isNaN(self.minutes)) {
        //         self.minutes = 0;
        //     }
        //     self.setTime();
        // },
        //
        //

        //
        //
        //
        //
        //
        //
        //
        //
        //
        // stop: function () {
        //     var self = this;
        //     clearInterval(self.timerId);
        //     if (self.samplePlayTimeouts) {
        //         $.each(self.samplePlayTimeouts, function (index, value) {
        //             clearTimeout(value);
        //         });
        //     }
        //     $('audio').stop;
        //     // if (self.sampleSounds) {
        //     //     $.each(self.sampleSounds, function (index, value) {
        //     //         value.stop();
        //     //     });
        //     // }
        // },
        //
        // reset: function () {
        //     var self = this;
        //     clearInterval(self.timerId);
        //     self.milliseconds = 0;
        //     self.seconds = 0;
        //     self.minutes = 0;
        //     $('#miliseconds').html('000');
        //     $('#seconds').html('00');
        //     $('#minutes').html('00');
        //     var pointer = $('#track-pointer');
        //     pointer.attr('data-position', 0);
        //     pointer.css('left', 0);
        // },
        //
        // initDraggable: function () {
        //     this.$el.find('.draggable-items').find('button').draggable({
        //         revert: "invalid",
        //         cancel: "a.ui-icon",
        //         containment: "document",
        //         helper: "clone",
        //         cursor: "move"
        //     });
        //     $('#track-pointer').draggable({axis: "x"});
        // },
        //
        //
        // removeProperty: function (event) {
        //     var self = this;
        //     $(event.currentTarget).parent().remove();
        //     self.setJson();
        // },
        //
        // setJson: function () {
        //     var self = this;
        //     var result = [];
        //     var tracks = $('.track');
        //     var trackOrder = 0;
        //     $.each(tracks, function () {
        //         var track = {
        //             "order": trackOrder,
        //             "samples": []
        //         };
        //         var sampleOrder = 0;
        //         var samples = $(this).find('.dropped-sample');
        //         $.each(samples, function () {
        //             var sampleItem = $(this);
        //             var sample = {
        //                 "order": sampleOrder,
        //                 "id": sampleItem.attr('data-id'),
        //                 "duration": sampleItem.attr('data-duration'),
        //                 "title": sampleItem.attr('data-title'),
        //                 "url": sampleItem.attr('data-url'),
        //             }
        //             track.samples.push(sample)
        //             sampleOrder++;
        //         });
        //         result.push(track);
        //         trackOrder++;
        //     });
        //     $.when.apply($, result).then(function () {
        //         self.json = result;
        //         self.setSamplePlayList();
        //     });
        // },
        //
        // setSamplePlayList: function () {
        //     var self = this;
        //     var list = [];
        //     var tracks = self.json;
        //     if (tracks) {
        //         $.each(tracks, function (index, value) {
        //             var samples = value.samples;
        //             var timeCounter = 0;
        //             $.each(samples, function (index, value) {
        //                 var item = {
        //                     "startTime": timeCounter,
        //                     "title": value.title,
        //                     "mp3url": value.mp3url,
        //                     "order": value.order
        //                 };
        //                 timeCounter += parseInt(value.duration) * 1000;
        //                 list.push(item);
        //             });
        //         });
        //     }
        //     $.when.apply($, list).then(function () {
        //         self.samplePlayList = list;
        //     });
        // },
        //
        // saveLayout: function () {
        //     var self = this;
        //     self.enableAjaxPageBlock();
        //     $.ajax({
        //         type: 'POST',
        //         data: {
        //             layoutId: self.$el.find('#layout-id').val(),
        //             layoutJson: self.layoutJson
        //         },
        //         url: Global.saveMix,
        //         success: function () {
        //             self.disableAjaxPageBlock();
        //         }
        //     });
        // },
        //
        // enableAjaxPageBlock: function () {
        //     this.$el.prepend('<div class="ajax-page-block"></div>');
        // },
        //
        // disableAjaxPageBlock: function () {
        //     this.$el.find('.ajax-page-block').remove();
        // }

    });
    new MixPageView();
});

