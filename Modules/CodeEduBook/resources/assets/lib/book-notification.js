module.exports = {
    init() {
        if (window.Laravel.userId != null) {
            window.Echo.private('CodeEduUser.Models.User.'. window.Laravel.userId)
                .notification(notification => {
                    window.$.notify({message: 'O livro ' + notification.book.title + ' foi exportado.'},{type: 'success'});
                });
        }
    }
};