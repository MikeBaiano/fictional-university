import $ from "jquery";

class MyNotes {
    constructor() {
        this.events();
    }

    events() {
        $('#my-notes').on('click', '.delete-note', this.deleteNote.bind(this));
        $('#my-notes').on('click', '.edit-note', this.editNote.bind(this));
        $('#my-notes').on('click', '.update-note', this.updateNote.bind(this));
        $('.submit-note').on('click', this.createNote.bind(this));
    }
    // Methods will go here
    editNote(e) {
        var thisNote = $(e.target).parents('li');
        if (thisNote.data('state') == 'editable') {
            this.makeNoteReadonly(thisNote);
        } else {
            this.makeNoteEditable(thisNote);
        }
    } 
    
    makeNoteEditable(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-times" aria-hidden="true"></i>Cancel');
        
        // Save original values before editing
        thisNote.data('original-title', thisNote.find('.note-title-field').val());
        thisNote.data('original-body', thisNote.find('.note-body-field').val());
        
        // Remove readonly attribute to make fields editable
        thisNote.find('.note-title-field').removeAttr('readonly').addClass('note-active-field');
        thisNote.find('.note-body-field').removeAttr('readonly').addClass('note-active-field');

        thisNote.find('.update-note').addClass('update-note--visible');
        thisNote.data('state', 'editable');
    }

    makeNoteReadonly(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-pencil" aria-hidden="true"></i>Edit');
        
        // Restore original values when canceling
        thisNote.find('.note-title-field').val(thisNote.data('original-title'));
        thisNote.find('.note-body-field').val(thisNote.data('original-body'));
        
        // Make fields readonly again
        thisNote.find('.note-title-field').attr('readonly', 'readonly').removeClass('note-active-field');
        thisNote.find('.note-body-field').attr('readonly', 'readonly').removeClass('note-active-field');

        thisNote.find('.update-note').removeClass('update-note--visible');
        thisNote.data('state', 'readonly');
    }
    
    deleteNote(e) {
        var thisNote = $(e.target).parents('li');

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            success: (response) => {
                console.log('note deleted');
                console.log(response)
                thisNote.slideUp();
                this.updateNoteCount('delete');
            },
            error: (response) => {
                console.log('note not deleted');
                console.log(response);
            }
        });
    }

    updateNote(e) {
        var thisNote = $(e.target).parents('li');

        var ourUpdatedPost = {
            title: thisNote.find('.note-title-field').val(),
            content: thisNote.find('.note-body-field').val()
        }

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatedPost,
            success: (response) => {
                console.log('note updated');
                console.log(response)
                // Update the original values with the new saved values
                thisNote.data('original-title', thisNote.find('.note-title-field').val());
                thisNote.data('original-body', thisNote.find('.note-body-field').val());
                this.makeNoteReadonly(thisNote);
            },
            error: (response) => {
                console.log('note not updated');
                console.log(response);
            }
        });
    }

    createNote(e) {
        var ourNewPost = {
            title: $('.new-note-title').val(),
            content: $('.new-note-body').val(),
            status: 'publish'
        }

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
                $('.new-note-title').val('');
                $('.new-note-body').val('');
                $(`
                    <li data-id="${response.id}">
                        <input readonly class="note-title-field" value="${response.title.raw}">
                        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>
                        <textarea readonly class="note-body-field">${response.content.raw}</textarea>
                        <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                        <hr>
                    </li>
                `).prependTo('#my-notes').hide().slideDown();
                console.log('note created');
                console.log(response)
                this.updateNoteCount('create');
            },
            error: (response) => {
                console.log('note not created');
                console.log(response);
                
                // Check if the error is due to note limit
                if (response.responseText && response.responseText.includes('limit')) {
                    $('#note-limit-message').text('Note Limit Reached! Delete a note to make room.').fadeIn();
                    
                    // Hide the message after 3 seconds
                    setTimeout(() => {
                        $('#note-limit-message').fadeOut();
                    }, 3000);
                }
            }
        });
    }

    updateNoteCount(action) {
        var currentCount = parseInt($('#note-limit-display').text());
        var newCount = action === 'delete' ? currentCount + 1 : currentCount - 1;
        $('#note-limit-display').text(newCount);
    }
}

export default MyNotes;