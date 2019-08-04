$(document).ready(function () {
    var InitView = Backbone.View.extend({

        el: '.container',

        events: {
            'click .confirm': 'onClickConform'
        },

        initialize: function () {

        },

        onClickConform: function () {
            if (!confirm("Are you sure you want delete this item?")) {
                return false;
            }
        }

    });
    new InitView();
});

