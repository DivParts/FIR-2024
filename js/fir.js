var id
var like
var addtekst = 0;
var showblog = 'Feiko';
var prgName = 'FIR';
var prgName = "<?echo $status;?>";
var Xplay = 0;

function statusUitzending(myValue) {
    $('#status').val(myValue)
        .trigger('change');
}

$(document).on('click', '.videoBtn', function() {
    var status = prgName;
    $('.art').css("display", "none");
    $('#twitch-embed').css("display", "block");
});

if (prgName == '24/7') {
    $('#twitch-embed').css("display", "none");
}
if (prgName == 'Wilbert') {
    new Twitch.Player("twitch-embed", { channel: "wilbertkooij", muted: true });
}
if (prgName == 'Arno') {
    new Twitch.Player("twitch-embed", { channel: "arnobakker", muted: true });
}
if (prgName == 'Rene') {
    new Twitch.Player("twitch-embed", { channel: "deplatenkast", muted: true });
}

$(document).on('click', '.mute_btn', function() {
    var bool = $("#stream").prop("muted");
    $("#stream").prop("muted", !bool);
    //$('.mute_btn').toggle('1000');
    $("i", this).toggleClass("bi-volume-up bi-volume-mute");
});

if ($("#stream").prop('muted')) {
    $('.mute_btn').css("background-color", "green")
};


$(document).ready(function() {
    $('.tf1').css("background-color", "white");
    createCookie("key", "lul", "1");
});

$(document).on('click', '.tf1', function() {
    $('.tb1').show();
    $('.tf1').css("background-color", "white");
    $('.tb2').hide();
    $('.tf2').css("background-color", "");
    $('.tb3').hide();
    $('.tf3').css("background-color", "");
});

$(document).on('click', '.tf2', function() {
    $('.tb2').show();
    $('.tf2').css("background-color", "white");
    $('.tb1').hide();
    $('.tf1').css("background-color", "");
    $('.tb3').hide();
    $('.tf3').css("background-color", "");
});

$(document).on('click', '.tf3', function() {
    $('.tb3').show();
    $('.tf3').css("background-color", "white");
    $('.tb1').hide();
    $('.tf1').css("background-color", "");
    $('.tb2').hide();
    $('.tf2').css("background-color", "");
});

/**$(document).on('click', '#btn-ShowFotoTekstRaam', function(){
   var addtekst = $(this).attr('value');
   $("fototekstraam").fadeIn("slow");
   $("body").css("background-color","#333333").fadeIn("slow");
     $.get("fototekst.php?index="+addtekst, function(data){
       $("#fotoverhaal").html(data);
   });
 });**/

$(document).on('click', '#btn-ShowModalDj', function() {
    var addtekst = $(this).attr('value');
    $("modal-dj").slideDown("slow");
    //$(".contfoto").fadeTo("slow" , 1);
    $.get("fototekst.php?index=" + addtekst, function(data) {
        $("#fotoverhaal").html(data);
    });
});

$(document).on('click', '#btn-ShowModalBlog', function() {
    var showblog = $(this).attr('value');
    $("modal-blog").slideDown("slow");
    $.get("blogtext.php?index=" + showblog, function(data) {
        $("#blogverhaal").html(data);
    });
});

$(document).on('click', '#btn-like', function() {
    var id = $(this).attr('value1');
    var like = $(this).attr('value2');
    like++;
    $.ajax({
        type: "POST",
        url: "blog-update.php",
        data: { "blogId": id, "blogLike": like },
        success: function(result) {
            $('#blog_like' + id).html(like);
            $(this).attr('value1', like);
        }
    });
});

$(document).on('click', '#btn-close', function() {
    $("fototekstraam").hide();
    $("body").css("background-color", "white");
    $("#mailto").hide();
    $("modal-thumbs-up").hide();
    $("modal-thumbs-down").hide();
    $("modal-dj").slideUp("slow");
    $("modal-blog").slideUp("slow");
    $('phoneNumber').hide();
    $(".contfoto").fadeTo("slow", 1);
});

/* alles wat met de players te maken heeft */

var x = $('#stream').get(0);

$(document).on('click', '#playAudioBtn', function() {
    x.play();
    Xplay = "1";
    $('.refreschTop').load('live_stat.php');
    createCookie("key", "none", "1");
    $('.stream').hide();
    //$('.on').show();
});


// Function to create the cookie 
function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = (name) + "=" +
        (value) + expires + "; path=/;SameSite=Lax";
}

myInterval = setInterval(function() {
    if (Xplay == '1') { $('.refreschTop').load('live_stat.php'); }
    $('.refreschpromo').load('promo.php');
    $('.refreschblog').load('blog.php');
}, 5000);

$(document).on('click', '.verzoekBtn', function() {
    $('#bericht').load('contact.php');
    $('#bericht').slideDown('slow');
    $('#Message').trigger(':reset');
    $('#Title').trigger(':reset');
});

$(document).on('click', '.appBtn', function() {
    $('phoneNumber').slideDown("slow");
});

$(document).on('click', '#thumbs-down-btn', function() {
    var PlayLike = -1;
    var PlayId = $(this).attr('value');
    $.ajax({
        type: "POST",
        url: "vote_update.php",
        data: { "PlayId": PlayId, "PlayLike": PlayLike },
        success: function(result) {
            $('modal-thumbs-down').show();
        }
    });
});

$(document).on('click', '#thumbs-up-btn', function() {
    var PlayLike = 1;
    var PlayId = $(this).attr('value');
    $.ajax({
        type: "POST",
        url: "vote_update.php",
        data: { "PlayId": PlayId, "PlayLike": PlayLike },
        success: function(result) {
            $('modal-thumbs-up').show();
        }
    });
});

/* end players */

/* berichten sturen */

$(document).on('submit', '#emailform', function(event) {
    event.preventDefault(); // Prevent default action
    var form_data = $(this).serialize(); // Encode form elements for submission
    $.ajax({
        url: "contact-form-process.php",
        type: "POST",
        data: form_data
    }).done(function(response) { //
        $('#mailto').hide();
        $('#stationName').show()
        $('#Message').val(' ');
        $('#Message1').val(' ');
        $('#Title').val(' ');
    });
});

$(document).on('change', 'input:radio[name=keuzeBericht]', function(event) {
    if (this.value == 'keuze1') {
        $('#keuzeOn').show();
        $('#keuzeOff').hide();
        $('#Message').val(' ');
        $('#Message1').val(' ');
        $('#Title').val(' ');
    } else if (this.value == 'keuze2') {
        $('#keuzeOn').hide();
        $('#keuzeOff').show();
        $('#Message').val(' ');
        $('#Message1').val(' ');
        $('#Title').val(' ');
    }
});

/* end berichten */