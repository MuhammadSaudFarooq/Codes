<li class="dokan-store-support-btn-wrap dokan-right">
    <button class="dokan-btn dokan-btn-theme dokan-btn-sm dokan-live-chat" style="padding-left: 23px;">
        Chat Now
        <span style="position: absolute; top: 9px; left: 7px; width: 9px; height: 9px; border-radius: 50%; background: rgb(121, 227, 121); z-index: 999;"></span>
    </button>
    <script type="text/javascript">
        (function(t,a,l,k,j,s){
        s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.getElementsByTagName('head')[0].appendChild(s);k=t.Promise;
        t.Talk={ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l.push([f])},catch:function(){return k&&new k()},c:l}};
        })(window,document,[]);
    </script>
    <script type="text/javascript">
    Talk.ready.then( function() {

    var customer = new Talk.User( {
        id: "58",
        name: "Tom",
        email: "stallyons.tester2@gmail.com",
        configuration: "vendor",
        photoUrl: "https://secure.gravatar.com/avatar/408bec7e7ad9d0b7a4ac17573bf79bae?s=96&#038;d=mm&#038;r=g",
    } );

    window.talkSession = new Talk.Session( {
        appId: "tFy5lVki",
        me: customer,
        signature: "53697d79c351e5b4359b122ebf27d97fc2f570a180a00802808aa02fa80cc68d"
    } );

    var seller = new Talk.User( {
        id: "61",
        name: "john",
        email: "stallyons.tester3@gmail.com",
        configuration: "vendor",
        photoUrl: "https://secure.gravatar.com/avatar/cd3fdba57bebc64111ffcdab347fe97f?s=96&#038;d=mm&#038;r=g",
        welcomeMessage: "How may I help you?"
    } );

    // popup the chat box when there is a new message and close the popop if browser get refreashed
    window.talkSession.unreads.on( 'change', function ( conversation ) {
        var unreadCount = conversation.length;

        if ( unreadCount > 0 ) {
            var popup = talkSession.createPopup();
        }

        // if popup is not empty and there is a unread message
        if ( popup != '' ) {
            if ( unreadCount > 0 ) {
                popup.mount();
            }
        }

    } );

    // if its shortcode ( meaning if its product page or seller store page ): chat_btn !== null
    var chat_btn = document.querySelector( '.dokan-live-chat' );

    if ( chat_btn !== null ) {
        chat_btn.addEventListener( 'click', function( e ) {
            e.preventDefault();

            var conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(customer, seller));
            conversation.setParticipant(customer);
            conversation.setParticipant(seller);
            var inbox = talkSession.createInbox({selected: conversation});
            var popup = talkSession.createPopup(conversation);
            popup.mount();
        } );
    }
} );
</script>
</li>
        <script type="text/javascript">
var dokan_chat = document.querySelector( '.dokan-live-chat' );
var span = document.createElement( 'span' );

dokan_chat.appendChild( span );

var chat_btn = document.querySelector( '.dokan-live-chat span' );

dokan_chat.style.paddingLeft = '23px';
chat_btn.style.position = 'absolute';
chat_btn.style.top = '9px';
chat_btn.style.left = '7px';
chat_btn.style.width = '9px';
chat_btn.style.height = '9px';
chat_btn.style.borderRadius = '50%';
chat_btn.style.background = '#79e379';
chat_btn.style.zIndex = '999';
</script>