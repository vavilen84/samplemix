$(document).ready(function () {
    var CollectionView = Backbone.View.extend({

        el: '.container',

        events: {
            'click .remove-sample-from-collection': 'removeSampleFromCollection'
        },

        initialize: function () {
            this.setPlayMode();
        },

        removeSampleFromCollection: function (e) {
            var self = this;
            $.ajax({
                type: 'POST',
                data: {
                    sampleId: $(e.currentTarget).attr('data-sample_id'),
                    collectionId: $('#collection-id').val()
                },
                url: Global.removeSampleFromCollection,
                success: function (response) {
                    window.location.reload();
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
    new CollectionView();
});

