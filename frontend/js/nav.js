activateMenu();

function activateMenu()
{
    var current_page_URL = location.href;

    $(".navbar-nav a").each(function()
    {
        var target_URL = $(this).prop("href");
        
        if (target_URL === current_page_URL)
        {
            // $('nav-link a').parents('li, ul').removeClass('nav-link');
            $(this).addClass('nav-link-active');
            return false;
        }
    });
}