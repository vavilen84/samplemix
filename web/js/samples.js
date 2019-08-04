$(document).ready(function () {
    var SamplePageView = Backbone.View.extend({

        el: '.container',

        events: {
            'click .add-to-collection-btn': 'addToCollection'
        },

        initialize: function () {
            this.setPlayMode();
        },

        addToCollection: function (e) {
            var self = this;
            var curEl = $(e.currentTarget);
            var sampleId = curEl.attr('data-sample_id');
            $.ajax({
                type: 'POST',
                data: {
                    sampleId: sampleId,
                    collectionId: $('[data-collection_sample_id=' + sampleId + ']').val()
                },
                url: Global.addSampleToCollection,
                success: function (response) {

                }
            });
        },

        setPlayMode: function () {
            window.addEventListener("play", function (evt) {
                if (window.$_currentlyPlaying) {
                    window.$_currentlyPlaying.pause();
                }
                window.$_currentlyPlaying = evt.target;
            }, true);
        }

    });
    new SamplePageView();
});

