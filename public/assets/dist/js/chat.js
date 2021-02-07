const { functions } = require("lodash");

$(document).ready(function(){
    $('.messages_owner').on('change', function () {
        $('.card-footer form').attr('action', '/chatclinet');
    });
});