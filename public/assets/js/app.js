(function($) {

    'use strict';

    var Webarch = function() {
        this.$body = $('body');
    }
    // Set environment vars
    Webarch.prototype.initHorizontalMenu = function() {
        $('.horizontal-menu .bar-inner > ul > li').on('click', function () {
            $(this).toggleClass('open').siblings().removeClass('open');

        });
         if($('body').hasClass('horizontal-menu')){
            $('.content').on('click', function () {
                $('.horizontal-menu .bar-inner > ul > li').removeClass('open');
            });
         }
    }
    // Tooltip
    Webarch.prototype.initTooltipPlugin = function() {
        $.fn.tooltip && $('[data-toggle="tooltip"]').tooltip({container: 'body'});
    }
    // Popover
    Webarch.prototype.initPopoverPlugin = function() {
        $.fn.popover && $('[data-toggle="popover"]').popover();
    }
    // Retina Images
    Webarch.prototype.initUnveilPlugin = function() {
        $.fn.unveil && $("img").unveil();
    }
    // Auto Scroll Up
    Webarch.prototype.initScrollUp = function() {
        $('[data-webarch="scrollup"]').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 700);
            return false;
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('[data-webarch="scrollup"]').fadeIn();
            } else {
                $('[data-webarch="scrollup"]').fadeOut();
            }
        });
    }
    // Portlet / Panel Tools
    Webarch.prototype.initPortletTools = function() {
        var $this = this;
        $('.grid .tools a.remove').on('click', function () {
            var removable = jQuery(this).parents(".grid");
            if (removable.next().hasClass('grid') || removable.prev().hasClass('grid')) {
                jQuery(this).parents(".grid").remove();
            } else {
                jQuery(this).parents(".grid").parent().remove();
            }
        });

        $('.grid .tools a.reload').on('click', function () {
            var el = jQuery(this).parents(".grid");
            $this.blockUI(el);
            window.setTimeout(function () {
                $this.unblockUI(el);
            }, 1000);
        });

        $('.grid .tools .collapse, .grid .tools .expand').on('click', function () {
            var el = jQuery(this).parents(".grid").children(".grid-body");
            if (jQuery(this).hasClass("collapse")) {
                jQuery(this).removeClass("collapse").addClass("expand");
                el.slideUp(200);
            } else {
                jQuery(this).removeClass("expand").addClass("collapse");
                el.slideDown(200);
            }
        });
        $('.widget-item > .controller .reload').click(function () {
            var el = $(this).parent().parent();
            $this.blockUI(el);
            window.setTimeout(function () {
                $this.unblockUI(el);
            }, 1000);
        });
        $('.widget-item > .controller .remove').click(function () {
            $(this).parent().parent().parent().addClass('animated fadeOut');
            $(this).parent().parent().parent().attr('id', 'id_remove_temp_id');
            setTimeout(function () {
                $('#id_remove_temp_id').remove();
            }, 400);
        });

        $('.tiles .controller .reload').click(function () {
            var el = $(this).parent().parent().parent();
            $this.blockUI(el);
            window.setTimeout(function () {
                $this.unblockUI(el);
            }, 1000);
        });
        $('.tiles .controller .remove').click(function () {
            $(this).parent().parent().parent().parent().addClass('animated fadeOut');
            $(this).parent().parent().parent().parent().attr('id', 'id_remove_temp_id');
            setTimeout(function () {
                $('#id_remove_temp_id').remove();
            }, 400);
        });
        if (!jQuery().sortable) {
            return;
        }
        $(".sortable").sortable({
            connectWith: '.sortable',
            iframeFix: false,
            items: 'div.grid',
            opacity: 0.8,
            helper: 'original',
            revert: true,
            forceHelperSize: true,
            placeholder: 'sortable-box-placeholder round-all',
            forcePlaceholderSize: true,
            tolerance: 'pointer'
        });
    }
    // Scrollbar Plugin
    Webarch.prototype.initScrollBar = function(){
        $.fn.scrollbar && $('.scroller').each(function () {
            var h = $(this).attr('data-height');
            $(this).scrollbar({
                ignoreMobile:true
            });
            if(h != null  || h !=""){
                if($(this).parent('.scroll-wrapper').length > 0)
                    $(this).parent().css('max-height',h);
                else
                    $(this).css('max-height',h);
            }
        });
    }
    // Sidebar
    Webarch.prototype.initSideBar = function(){
        var sidebar = $('.page-sidebar');
        var sidebarWrapper = $('.page-sidebar .page-sidebar-wrapper');
        sidebar.find('li > a').on('click', function (e) {
            if ($(this).next().hasClass('sub-menu') === false) {
                return;
            }
            var parent = $(this).parent().parent();
            parent.children('li.open').children('a').children('.arrow').removeClass('open');
            parent.children('li.open').children('a').children('.arrow').removeClass('active');
            parent.children('li.open').children('.sub-menu').slideUp(200);
            parent.children('li').removeClass('open');

            var sub = jQuery(this).next();
            if (sub.is(":visible")) {
                jQuery('.arrow', jQuery(this)).removeClass("open");
                jQuery(this).parent().removeClass("active");
                sub.slideUp(200, function () {
                });
            } else {
                jQuery('.arrow', jQuery(this)).addClass("open");
                jQuery(this).parent().addClass("open");
                sub.slideDown(200, function () {
                });
            }
            e.preventDefault();
        });
        //Auto close open menus in Condensed menu
        if (sidebar.hasClass('mini')) {
            var elem = jQuery('.page-sidebar ul');
            elem.children('li.open').children('a').children('.arrow').removeClass('open');
            elem.children('li.open').children('a').children('.arrow').removeClass('active');
            elem.children('li.open').children('.sub-menu').slideUp(200);
            elem.children('li').removeClass('open');
        }
        $.fn.scrollbar && sidebarWrapper.scrollbar();
    }

    // Util Functions
    Webarch.prototype.initUtil = function(){
        $('[data-height-adjust="true"]').each(function () {
            var h = $(this).attr('data-elem-height');
            $(this).css("min-height", h);
            $(this).css('background-image', 'url(' + $(this).attr("data-background-image") + ')');
            $(this).css('background-repeat', 'no-repeat');
            if ($(this).attr('data-background-image')) {

            }
        });

        $('[data-aspect-ratio="true"]').each(function () {
            $(this).height($(this).width());
        });

        $('[data-sync-height="true"]').each(function () {
            equalHeight($(this).children());
        });

        $('[data-webarch-toggler="checkall"]').on('click', function () {
            var $el = $(this);
            var $table =  $el.closest('table');
            if ($el.is(':checked')) {
                $table.find(':checkbox').attr('checked', true);
                $table.find('tr').addClass('row_selected'); 
            } else {
               $table.find(':checkbox').attr('checked', false);
               $table.find('tr').removeClass('row_selected');
            }
        });

        $(window).resize(function () {
            $('[data-aspect-ratio="true"]').each(function () {
                $(this).height($(this).width());
            });
            $('[data-sync-height="true"]').each(function () {
                equalHeight($(this).children());
            });

        });
        function equalHeight(group) {
            var tallest = 0;
            group.each(function () {
                var thisHeight = $(this).height();
                if (thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            group.height(tallest);
        }
    }
    // Progress bar animation
    Webarch.prototype.initProgress = function(){
        $('[data-init="animate-number"], .animate-number').each(function () {
            var data = $(this).data();
            if (data.value != 0) {
            $(this).animateNumber({
                number: data.value
            },
            'normal',
            function() {
                $(this).text(data.value)
            });
    }
        });
        $('[data-init="animate-progress-bar"], .animate-progress-bar').each(function () {
            var data = $(this).data();
            $(this).css('width', data.percentage);
        });
    }
    // Select2 Plugin
    Webarch.prototype.initSelect2Plugin = function() {
        $.fn.select2 && $('[data-init-plugin="select2"]').each(function() {
            $(this).select2({
                minimumResultsForSearch: ($(this).attr('data-disable-search') == 'true' ? -1 : 1)
            }).on('select2-opening', function() {
                $.fn.scrollbar && $('.select2-results').scrollbar({
                    ignoreMobile: false
                })
            });
        });
    }
    // Form Elements
    Webarch.prototype.initFormElements = function(){
        $(".inside").children('input').blur(function () {
            $(this).parent().children('.add-on').removeClass('input-focus');
        });

        $(".inside").children('input').focus(function () {
            $(this).parent().children('.add-on').addClass('input-focus');
        });

        $(".input-group.transparent").children('input').blur(function () {
            $(this).parent().children('.input-group-addon').removeClass('input-focus');
        });

        $(".input-group.transparent").children('input').focus(function () {
            $(this).parent().children('.input-group-addon').addClass('input-focus');
        });

        $(".bootstrap-tagsinput input").blur(function () {
            $(this).parent().removeClass('input-focus');
        });

        $(".bootstrap-tagsinput input").focus(function () {
            $(this).parent().addClass('input-focus');
        });
    }
    // Validation Plugin
    Webarch.prototype.initValidatorPlugin = function() {
        $.validator && $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var parent = $(element).closest('.form-group');
                if (parent.hasClass('form-group-default')) {
                    parent.addClass('has-error');
                    error.insertAfter(parent);
                } else {
                    error.insertAfter(element);
                }
            },
            onfocusout: function(element) {
                var parent = $(element).closest('.form-group');
                if ($(element).valid()) {
                    parent.removeClass('has-error');
                    parent.next('.error').remove();
                }
            },
            onkeyup: function(element) {
                var parent = $(element).closest('.form-group');
                if ($(element).valid()) {
                    $(element).removeClass('error');
                    parent.removeClass('has-error');
                    parent.next('label.error').remove();
                    parent.find('label.error').remove();
                } else {
                    parent.addClass('has-error');
                }
            },
            success: function (label, element) {
                // var parent = $(element).parent('.input-with-icon');
                // parent.removeClass('error-control').addClass('success-control'); 
            },
        });

        $('.validate').validate();
    }
    // Block UI
    Webarch.prototype.blockUI = function(el){
        $(el).block({
            message: '<div class="loading-animator"></div>',
            css: {
                border: 'none',
                padding: '2px',
                backgroundColor: 'none'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.3,
                cursor: 'wait'
            }
        });
    }
    Webarch.prototype.unblockUI = function(el){
        $(el).unblock();
    }
    // Call initializers
    Webarch.prototype.init = function() {
        // init layout
        this.initSideBar();
        this.initHorizontalMenu();
        this.initPortletTools();
        this.initScrollUp();
        this.initProgress();
        this.initFormElements();
        // init plugins
        this.initSelect2Plugin();
        this.initUnveilPlugin();
        this.initScrollBar();
        this.initTooltipPlugin();
        this.initPopoverPlugin();
        //this.initValidatorPlugin();
        this.initUtil();

    }

    $.Webarch = new Webarch();
    $.Webarch.Constructor = Webarch;

})(window.jQuery);


$(function() {
    'use strict';
    $.Webarch.init();
});