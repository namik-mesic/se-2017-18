var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
    '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';

$(document).ready(function () {

    getConversation();

    $('[data-toggle="tooltip"]').tooltip();

    $('#hideSidebar').on('click', function () {
       hideSidebar();
    });

    $('#showSidebar').on('click', function () {
        showSidebar();
    });

    $('#addConversationUsers').selectize({
        persist: false,
        maxItems: null,
        valueField: 'email',
        labelField: 'name',
        searchField: ['name', 'email'],
        options: [
            {email: 'brian@thirdroute.com', name: 'Brian Reavis'},
            {email: 'nikola@tesla.com', name: 'Nikola Tesla'},
            {email: 'someone@gmail.com'}
        ],
        render: {
            item: function(item, escape) {
                return '<div>' +
                    (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
                    (item.email ? '<span class="email">' + escape(item.email) + '</span>' : '') +
                    '</div>';
            },
            option: function(item, escape) {
                var label = item.name || item.email;
                var caption = item.name ? item.email : null;
                return '<div>' +
                    '<span class="label">' + escape(label) + '</span>' +
                    (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                    '</div>';
            }
        },
        createFilter: function(input) {
            var match, regex;

            // email@address.com
            regex = new RegExp('^' + REGEX_EMAIL + '$', 'i');
            match = input.match(regex);
            if (match) return !this.options.hasOwnProperty(match[0]);

            // name <email@address.com>
            regex = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
            match = input.match(regex);
            if (match) return !this.options.hasOwnProperty(match[2]);

            return false;
        },
        create: function(input) {
            if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
                return {email: input};
            }
            var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
            if (match) {
                return {
                    email : match[2],
                    name  : $.trim(match[1])
                };
            }
            alert('Invalid email address.');
            return false;
        }
    });

});

function hideSidebar() {
    var sidebar = $('#chat #my-panel');
    sidebar.addClass('hideSidebar');

    $('#sidebarButton').show();
}

function showSidebar() {
    var sidebar = $('#chat #my-panel');
    sidebar.removeClass('hideSidebar');

    $('#sidebarButton').hide();
}

function getConversation() {
    $.get("/api/conversation/" + AuthUser.id, function (conversations) {
        conversations = JSON.parse(conversations);

        var conversationHTML = '';

        if(conversations.data.length < 1) {
            conversationHTML = '<p class="no-data">You do not have any conversations yet.</p>';
        } else {
            conversations.data.forEach(function (conversation) {
                conversationHTML += '<div class="card" data-conversation="' + conversation.id + '">';
                if(conversation.messages.data.length > 0) {
                    conversationHTML += '<div class="corner-ribbon top-right sticky red">Unread</div>';
                }
                conversationHTML += '<div class="chat-images">';
                conversation.users.data.forEach(function (user, index) {
                    if (index === 0) {
                        conversationHTML += '<div class="chat-image big">' +
                                            '<img class="card-img-top" src="' + '/images/default_user.jpg' + '" alt="' + user.name + '">' +
                                            '</div>';
                    } else if (index === 1 || index === 2) {
                        conversationHTML += '<div class="chat-image small">' +
                                            '<img class="card-img-top" src="' + '/images/default_user.jpg' + '" alt="' + user.name + '">' +
                                            '</div>';
                    }
                });
                conversationHTML += '</div>';
                conversationHTML += '<div class="card-body">' +
                                    '<h4 class="card-title">';
                conversation.users.data.forEach(function (user) {
                    conversationHTML += '<span class="label label-primary badge-pill">' + user.name + '</span>'
                });
                conversationHTML += '</h4>';
                conversationHTML += '<p class="card-text"><b>' + conversation.messages.data["0"].user.data.name + '</b>: ' + conversation.messages.data["0"].text + '</p>';
                conversationHTML += '</div>';
                conversationHTML += '</div>';
            });

            $('.conversations-list').html(conversationHTML);

        }

    });
}