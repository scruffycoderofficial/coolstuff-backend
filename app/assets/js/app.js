require('./bootstrap');

import {
    listEntryItems,
    addItemEntry,
    checkEntryItem,
    removeEntryItem
} from "./functions";

$(document).ready(function(){

    listEntryItems();

    $('.submission-line__btn').on('click', function(event){
        event.preventDefault();

        addItemEntry();
    });

    $('.submission-line__input').keypress(function(event){
        if (event.which === 13) {
            addItemEntry();
        }
    });

    $('.list').on('click', '.list__delete-btn', function(){
        removeEntryItem($(this).parent().text());
    });

    $('.list').on('click', '.list__check-btn', function(){
        checkEntryItem($(this).parent().text(), $(this).data().marked);
    });
});