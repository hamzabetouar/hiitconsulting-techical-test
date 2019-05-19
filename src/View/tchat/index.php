<div class="card">
    <div class="card-header">
        <a class="float-right" href="/user/logout">Se déconnecter</a>
        <h3 class="card-title">Bonjour <?=$user->getUsername() ?> !</h3>
    </div>
    <div class="row" style="height: 500px;">
        <div class="col-9" style="padding-right: 0">
            <div class="tchat">
                <div style="height: 462px;border: 1px solid #ccc;display: none;overflow: auto" class="messages">
                    <div class="user-info" style="padding: 5px 10px 0">
                        <h3 class="text-right"></h3>
                    </div>
                    <hr>
                    <div class="content">
                        <div class="message">

                        </div>
                    </div>
                </div>

                <div class="form" style="display: none;">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Taper votre message" id="message">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="button-addon2" onclick="send()">
                                Envoyer
                            </button>
                        </div>
                    </div>
                </div>

                <div class="nuser">

                    <h2 style="padding-top:150px" class="text-center">Séléctionnez quelqu'un pour discuter</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="padding-left: 0;">
            <ul class="list-group" style="height: 500px;overflow: auto;">
                <?php foreach($users as $u):
                    if($u['id'] != $user->getId()): ?>
                <li id="u<?=$u['id'] ?>" class="list-group-item" style="cursor: pointer;" onclick="tchat(<?=$u['id'] ?>, '<?=$u['username'] ?>')">
                    <?php if(strtotime($u['last_connect_date']) > time() - 10 ): ?>
                        <span class="badge badge-success">&nbsp;</span>
                    <?php else: ?>
                        <span class="badge badge-danger">&nbsp;</span>
                    <?php endif ?>
                    <?=$u['username'] ?>
                </li>
                <?php endif; endforeach ?>
            </ul>
        </div>
    </div>
</div>

<style type="text/css">
    .message{
        padding: 10px;
    }
</style>

<script>
    var id = null;
    var username = null;
    var lastMessage = 0;
    var checkTimeout = null;

    function tchat(uid, name) {
        id = uid;
        username = name;

        $('.tchat .nuser').hide();
        $('.tchat .messages').show();
        $('.tchat .form').show();
        $('.tchat .user-info h3').text(username)

        $('.messages .content').html('');
        lastMessage = 0;

        clearTimeout(checkTimeout);
        checkTimeout = null;

        getMessages();
    }

    function send() {
        if( $('#message').val() != '' ) {
            $.post('/message/create', {
                uid: id, message: $('#message').val()
            }, function (response) {
                addMessage({message: $('#message').val(), sender_id : <?=$user->getId() ?>}, new Date())
                $('#message').val('');
            })
        }
    }

    function getMessages() {
        $.get('/message/messages?uid=' + id, function (response) {
            for(i = 0; i < response.length; i++){
                addMessage(response[i], new Date(response[i].created_at));
                lastMessage = response[i].id
            }
            checkTimeout = setTimeout(checkMessage, 500);
        }, 'json')

    }

    function addMessage(message, date) {
        if( message.sender_id == <?=$user->getId() ?> ) {
            m = $('<div class="message text-left">' +
                '<span class=" badge badge-success">'+message.message+'</span>' +
                '<br><span>'+ roundNumber(date.getDate()) + "/"+ roundNumber(date.getMonth()) + "/"+ date.getFullYear() + " "
                + roundNumber(date.getHours()) + ":" + roundNumber(date.getMinutes()) +'</span>' +
                '</div><hr>')
        } else {
            m = $('<div class="message text-right">' +
                '<span class=" badge badge-info">'+message.message+'</span>' +
                '<br><span>'+ roundNumber(date.getDate()) + "/"+ roundNumber(date.getMonth()) + "/"+ date.getFullYear() + " "
                + roundNumber(date.getHours()) + ":" + roundNumber(date.getMinutes()) +'</span>' +
                '</div><hr>')
        }

        $('.messages .content').append(m)

        document.querySelector('.messages').scrollTop = document.querySelector('.messages').scrollHeight;
    }

    function checkMessage() {
        $.get('/message/inbox?uid=' + id + '&mid=' + lastMessage, function (response) {
            for(i = 0; i < response.length; i++){
                addMessage(response[i], new Date(response[i].created_at));
                lastMessage = response[i].id
            }
            checkTimeout = setTimeout(checkMessage, 500);
        }, 'json')

    }

    function updateConnexion() {
        $.get('/user/update', function (response) {

            setTimeout(updateConnexion, 5000);
        })
    }

    function roundNumber(number) {
        if( number < 10 )
            return "0" + number
        return number;
    }

    function checkUsers() {
        $.get('/user/checkUsers', function (response) {
            for(i = 0; i < response.length; i++){
                elm = $('#u' + response[i].id);
                if(elm) {
                    badge = $(elm).find('.badge');
                    if( response[i].connect && $(badge).hasClass('badge-danger') ) {
                        $(badge).removeClass('badge-danger').addClass('badge-success')
                    }
                    if( !response[i].connect && $(badge).hasClass('badge-success') ) {
                        $(badge).removeClass('badge-success').addClass('badge-danger')
                    }
                }
            }
            setTimeout(checkUsers, 5000);
        },'json')
    }

    updateConnexion();
    checkUsers();
</script>