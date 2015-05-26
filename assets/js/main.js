(function ($) {
    /*---------------------------------
     Boostrap OPT ins
     -----------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();

    $('#carousel').carousel();

    $('.carousel .carousel-control.left').click(function () {
        $('#carousel').carousel('prev');
    });

    $('.carousel .carousel-control.right').click(function () {
        $('#carousel').carousel('next');
    });


    /*---------------------------------
     MENU
     -----------------------------------*/
    var $searchToggle = $('#search-toggle');
    var $navbar = $('#navbar');

    $searchToggle.click(function () {
        $navbar.addClass("searching");
        $(this).find('.form-control').focus();
    });

    $searchToggle.find('.form-control').blur(function () {
        $navbar.removeClass("searching");
    });

    /*---------------------------------
     SVDW
     -----------------------------------*/
    if ($('.svdw-container').length) {

        var type = ["kills", "assists", "gold_per_min", "xp_per_min", "last_hits", "denies", "hero_healing", "tower_damage", "hero_damage", "gold_spent"];
        var limit = 3;
        var order = 'desc';
        var current_svdw_type = 0;
        var svdwTimeout;

        setButtons();

        function setButtons() {
            $('.svdw-buttons').append($('<ul/>'));

            $.each(type, function (index) {
                var type_name = type[index].replace("_", " ");
                type_name = type_name.replace("per_", "/ ");

                $('.svdw-buttons ul').append($('<li data-type="'+type[index]+'">'+type_name+'</li>'));
            });

            $('.svdw-buttons ul li').click(function(){
                clearTimeout(svdwTimeout);

                current_svdw_type = type.indexOf($(this).attr('data-type'));

                $('.svdw-buttons ul li').removeClass('active');
                $('.svdw-buttons ul li[data-type*="'+type[current_svdw_type]+'"]').addClass('active');

                runSvdwRotation(14000);
            });
        }

        function runSvdwRotation(delay) {

                    svdwAnimateOut(function () {

                        getSvdwData(type[current_svdw_type], function (data) {
                            var players = data.players;

                            //PUT DATA
                            $('.player-stats').each(function (index) {

                                $(this).find('.profile').attr('src', players[index].imgurl);
                                $(this).find('.player-name a').attr('href', "http://www.dutchdota.com/lid/"+players[index].nicename).text(players[index].name);
                                var type_name = (players[index].stats.type).replace("_", " ");
                                type_name = type_name.replace("per_", "/ ");
                                $(this).find('.main-info strong').html(type_name + ":");
                                $(this).find('.main-info span').html(players[index].stats.score);
                                $(this).find('.hero-image').attr('src', players[index].stats.hero.imgurl);

                                var game_status = "Lost game";
                                if (players[index].stats.game_status == 1) {
                                    game_status = "Won game";
                                }

                                $(this).find('.game-status').text(game_status);
                                $(this).find('.date span').text(players[index].stats.date);
                                $(this).find('.game-kda').text(players[index].stats.kills + "/" + players[index].stats.deaths + "/" + players[index].stats.assists);

                            });


                            $('.svdw-buttons ul li').removeClass('active');
                            $('.svdw-buttons ul li[data-type*="'+type[current_svdw_type]+'"]').addClass('active');

                            svdwAnimateIn(function () {
                                if (current_svdw_type == type.length - 1) {
                                    current_svdw_type = 0;
                                } else {
                                    current_svdw_type++;
                                }

                                svdwTimeout = setTimeout(function () {

                                    runSvdwRotation(0);

                                }, 7000 + delay);

                            });

                        });

                    });
        }

        function svdwAnimateOut(callback) {
            if ($('.player-stats .stats-info').hasClass('firstload')) {

                setTimeout(function () {
                    callback();
                }, 1000);

            } else {
                $('.player-stats .stats-info').removeClass('bounceIn');

                setTimeout(function () {
                    callback();
                }, 800);
            }
        }

        function svdwAnimateIn(callback) {
            $('.player-stats .stats-info').removeClass('firstload');
            $('.player-stats .stats-info').addClass('bounceIn');

            setTimeout(function () {
                callback();
            }, 800);
        }

        function getSvdwData(type, callback) {
            $.ajax({
                url: "http://dota-api.dutchdota.com/svdw.php",
                dataType: 'jsonp',  //use jsonp data type in order to perform cross domain ajax
                crossDomain: true,
                data: {
                    type: type,
                    order: order,
                    limit: limit
                },
                type: 'GET',
                success: callback,
                error: function (data) {
                    console.log(data);
                }
            });
        }

        // Run
        runSvdwRotation(2000);

    }


    /*---------------------------------
     TWITCH STREAMS
     -----------------------------------*/
    if ($('.twitch-list').length) {

        function runTwitchListAnimation() {
            getTwitchList(function (data) {
                var twitch_list = data;

                $.each(twitch_list, function (index) {

                    setTimeout(function () {

                        twitchListAnimateOut(function () {

                            //PUT DATA
                            $('.twitch-list a').attr('href', twitch_list[index]['twitch_data']['url']).attr('target', "_blank");
                            $('.twitch-list a .stream-image').attr('src', twitch_list[index]['twitch_data']['preview_img']);
                            $('.twitch-list a .profile-image').attr('src', twitch_list[index]['photo_url']);
                            $('.twitch-list a .profile-name').text(twitch_list[index]['display_name']);
                            $('.twitch-list a .stream-text').text(twitch_list[index]['twitch_data']['status']);

                            twitchListAnimateIn(function () {
                                if (index == twitch_list.length - 1) {
                                    setTimeout(function () {

                                        runTwitchListAnimation();

                                    }, 7000);
                                }

                            });

                        });


                    }, 7000 * index);
                });
            });
        }

        function twitchListAnimateOut(callback) {
            if ($('.twitch-list a').hasClass('firstload')) {

                setTimeout(function () {
                    callback();
                }, 1000);

            } else {
                $('.twitch-list a').removeClass('fadeIn');

                setTimeout(function () {
                    callback();
                }, 800);
            }
        }

        function twitchListAnimateIn(callback) {
            $('.twitch-list a').removeClass('firstload');
            $('.twitch-list a').addClass('fadeIn');

            setTimeout(function () {
                callback();
            }, 800);
        }

        function getTwitchList(callback) {
            $.ajax({
                url: "http://dota-api.dutchdota.com/users_twitch_list.php",
                dataType: 'jsonp',  //use jsonp data type in order to perform cross domain ajax
                crossDomain: true,
                type: 'GET',
                success: callback,
                error: function (data) {
                    console.log(data);
                }
            });
        }

        runTwitchListAnimation();
    }


})(jQuery);