import ListItemsService from "./services/ListItemsService";
import {msgShowOkDialog} from "./dialogs";

/**
 * Updates the view list of the items
 */
function itemEntry(id, name, marked) {
    let listClass = marked ? 'list__item list__item--checked' : 'list__item';
    let marker = marked ? 0 : 1;

    $('.list').prepend(
        '<li class="'+ listClass +'">' +
        '<a class="list__delete-btn">X</a>'
        + name +
        '<a class="list__check-btn" data-marked="'+ marker +'">✔</a>' +
        '</li>'
    );
}

/**
 * Create a new EntryItem
 */
function addItemEntry() {
    let $input = $('.submission-line__input').val();

    if ($input) {

        ListItemsService
            .create({action: "create", name: $input, is_marked: 0 })
            .then(response => {
                if (response.data.success) {
                    msgShowOkDialog('New entry item', response.data.message, 'success');
                    $('.submission-line__input').val("");
                    window.setTimeout(function() {
                        location.reload();
                    } ,3000);
                } else {
                    msgShowOkDialog('New entry item', response.data.message, 'error');
                }
            }).catch(error => {
                msgShowOkDialog('New entry item', 'Something went wrong, contact System Administrator!', 'error');
        } );
    }
}

/**
 * List entry items
 */
function listEntryItems() {
    ListItemsService
        .getAll()
        .then(response => {
            response.data.forEach(item => {
                itemEntry(item.id, item.name, item.is_marked);
            });
        }).catch(error => {
            msgShowOkDialog('Entry item update', 'Something went wrong, contact System Administrator!', 'error');
    });
}

/**
 * Checks an entry item
 *
 * @param name
 * @param mark
 */
function checkEntryItem(name, mark) {
    let entry = trimEntryItem(name);

    $(this).parent().toggleClass('list__item--checked');
    $(this).siblings().toggleClass('list__delete-btn--checked');
    $(this).toggleClass('list__check-btn--checked');

    let $listItem = $(this).parent();

    ListItemsService
        .update({ action: 'update', name: entry, is_marked: mark })
        .then(response => {
            if (response.data.success) {
                msgShowOkDialog('Entry item update', response.data.message, 'success');
                if ($listItem.hasClass('list__item--checked')) {
                    $('.list').append($listItem);
                } else {
                    $('.list').prepend($listItem);
                }
                window.setTimeout(function(){
                    location.reload();
                } ,3000);
            } else {
                msgShowOkDialog('Entry item update', response.data.message, 'error');
            }
        }).catch(error => {
            msgShowOkDialog('Entry item update', 'Something went wrong, contact System Administrator!', 'error');
    });
}

/**
 * Removes an entry item
 *
 * @param name
 */
function removeEntryItem(name) {
    let entry = trimEntryItem(name);

    ListItemsService
        .delete({ action: 'delete', name: entry })
        .then(response => {
            if (response.data.success) {
                msgShowOkDialog('Entry item deletion', response.data.message, 'success');
                $(this).parent().fadeOut(300, function(){
                    $(this).remove();
                });
                window.setTimeout(function(){
                    location.reload();
                } ,3000);
            } else {
                msgShowOkDialog('Entry item deletion', response.data.message, 'error');
            }
        }).catch(error => {
            msgShowOkDialog('Entry item deletion', 'Something went wrong, contact System Administrator!', 'error');
    });
}

/**
 * @param itemEntry
 * @returns {string}
 */
function trimEntryItem(itemEntry)
{
    itemEntry = itemEntry.substring(1);
    itemEntry = itemEntry.substring(0, itemEntry.length - 1);

    return itemEntry;
}

export { itemEntry, addItemEntry, listEntryItems, checkEntryItem, removeEntryItem, trimEntryItem };