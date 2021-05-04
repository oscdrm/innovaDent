

    var mailWindow = null;
    $('#correo').on('click', function(c){
        c.preventDefault();
    if(mailWindow == null || mailWindow.closed)
        mailWindow = window.open('https://outlook.live.com/mail/0/inbox', 'mailWindow')
    else
        mailWindow.focus()
    });

    var hessyWindow = null;
    $('#agenda').on('click', function(a){
        a.preventDefault();
    if(hessyWindow == null || hessyWindow.closed)
        hessyWindow = window.open('https://innovadent.hessydental.com/', 'hessyWindow')
    else
        hessyWindow.focus()
    });
