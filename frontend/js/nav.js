activateMenu();

function activateMenu()
{
    var current_page_URL = location.href;

    $(".navbar-nav a").each(function()
    {
        var target_URL = $(this).prop("href");
        if (target_URL === current_page_URL)
        {
            $('nav a').parents('li, ul').removeClass('navlink2');
            $(this).parent('li').addClass('navlink2');
            return false;
        }
    });
}