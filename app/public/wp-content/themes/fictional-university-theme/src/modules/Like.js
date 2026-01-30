import $ from 'jquery';

class Like {
    constructor() {
        this.events();
    }

    events() {
        $('.like-box').on('click', this.ourClickDispatcher.bind(this));
    }

    // methods
    ourClickDispatcher(e) {
        const currentLikeBox = $(e.target).closest('.like-box');
        if (currentLikeBox.data('exists') == 'yes') {
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox);
        }
    }

    createLike(currentLikeBox) {
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {
                'postID': currentLikeBox.data('post')
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox) {
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            data: {
                'postID': currentLikeBox.data('post')
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
}

export default Like;