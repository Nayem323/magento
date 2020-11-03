define([
    "jquery",
    'uiGridColumnsActions'
], function($, actions){
    'use strict';

    if($('body').hasClass('n23-videoplayer-videoplayer-index')){
        return actions.extend({
            defaults: {
                draggable: true,
                sortable: true
            }
        });
    }else{
        return actions;
    }
});