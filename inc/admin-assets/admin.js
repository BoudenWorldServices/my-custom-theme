/**
 * Goliath Content Editor — admin panel JS.
 *
 * Handles WP Media Library picker, repeater add/remove/reorder.
 */
(function ($) {
    'use strict';

    /* ------------------------------------------------------------------ */
    /*  Media Library picker                                              */
    /* ------------------------------------------------------------------ */

    $(document).on('click', '.goliath-image-upload', function (e) {
        e.preventDefault();
        var $wrapper = $(this).closest('.goliath-image-field');
        var $input   = $wrapper.find('.goliath-image-value');
        var $preview = $wrapper.find('.goliath-image-preview');
        var $remove  = $wrapper.find('.goliath-image-remove');

        var frame = wp.media({
            title: 'Select Image',
            multiple: false,
            library: { type: 'image' },
            button: { text: 'Use this image' }
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            var url = attachment.sizes && attachment.sizes.medium
                ? attachment.sizes.medium.url
                : attachment.url;
            $input.val(attachment.id);
            $preview.find('img').attr('src', url);
            $preview.show();
            $remove.show();
        });

        frame.open();
    });

    $(document).on('click', '.goliath-image-remove', function (e) {
        e.preventDefault();
        var $wrapper = $(this).closest('.goliath-image-field');
        $wrapper.find('.goliath-image-value').val('');
        $wrapper.find('.goliath-image-preview').hide().find('img').attr('src', '');
        $(this).hide();
    });

    /* ------------------------------------------------------------------ */
    /*  Media Library picker — video                                      */
    /* ------------------------------------------------------------------ */

    $(document).on('click', '.goliath-video-upload', function (e) {
        e.preventDefault();
        var $wrapper = $(this).closest('.goliath-video-field');
        var $input   = $wrapper.find('.goliath-video-value');
        var $preview = $wrapper.find('.goliath-video-preview');
        var $remove  = $wrapper.find('.goliath-video-remove');

        var frame = wp.media({
            title: 'Select Video',
            multiple: false,
            library: { type: 'video' },
            button: { text: 'Use this video' }
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $input.val(attachment.url);
            $preview.find('.goliath-video-filename').text(attachment.filename || attachment.title);
            $preview.show();
            $remove.show();
        });

        frame.open();
    });

    $(document).on('click', '.goliath-video-remove', function (e) {
        e.preventDefault();
        var $wrapper = $(this).closest('.goliath-video-field');
        $wrapper.find('.goliath-video-value').val('');
        $wrapper.find('.goliath-video-preview').hide().find('.goliath-video-filename').text('');
        $(this).hide();
    });

    /* ------------------------------------------------------------------ */
    /*  Repeater — remove row                                             */
    /* ------------------------------------------------------------------ */

    $(document).on('click', '.goliath-repeater-remove', function (e) {
        e.preventDefault();
        var $row = $(this).closest('.goliath-repeater-row');
        var $repeater = $row.closest('.goliath-repeater');

        $row.slideUp(200, function () {
            $row.remove();
            reindexRepeater($repeater);
        });
    });

    /* ------------------------------------------------------------------ */
    /*  Repeater — add row                                                */
    /* ------------------------------------------------------------------ */

    $(document).on('click', '.goliath-repeater-add', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var optionKey = $btn.data('option');
        var template  = $btn.data('template');
        var $container = $btn.closest('.goliath-repeater').find('.goliath-repeater-items');
        var newIndex = $container.children('.goliath-repeater-row').length;

        var html = buildRepeaterRow(optionKey, newIndex, template);
        var $newRow = $(html).hide();
        $container.append($newRow);
        $newRow.slideDown(200);
    });

    /**
     * Build HTML for a new repeater row from template field definitions.
     */
    function buildRepeaterRow(optionKey, index, fields) {
        var html = '<div class="goliath-repeater-row" data-index="' + index + '">';
        html += '<div class="goliath-repeater-row-header">';
        html += '<span class="goliath-repeater-row-number">#' + (index + 1) + '</span>';
        html += '<button type="button" class="button-link goliath-repeater-remove" title="Remove item">Remove</button>';
        html += '</div>';

        $.each(fields, function (fieldName, fieldDef) {
            var nameAttr = 'goliath_fields[' + optionKey + '][' + index + '][' + fieldName + ']';
            var idAttr = 'goliath_' + optionKey + '_' + index + '_' + fieldName;
            html += '<div class="goliath-repeater-field">';
            html += '<label for="' + idAttr + '">' + escHtml(fieldDef.label) + '</label>';

            if (fieldDef.type === 'textarea') {
                html += '<textarea id="' + idAttr + '" name="' + nameAttr + '" rows="3" class="large-text"></textarea>';
            } else if (fieldDef.type === 'image') {
                html += '<div class="goliath-image-field" data-field="' + optionKey + '_' + index + '_' + fieldName + '">';
                html += '<input type="hidden" name="' + nameAttr + '" value="" class="goliath-image-value">';
                html += '<div class="goliath-image-preview" style="display:none"><img src="" alt="" style="max-width:120px;max-height:80px;"></div>';
                html += '<button type="button" class="button goliath-image-upload">Choose Image</button> ';
                html += '<button type="button" class="button goliath-image-remove" style="display:none">Remove</button>';
                html += '</div>';
            } else if (fieldDef.type === 'video') {
                html += '<div class="goliath-video-field" data-field="' + optionKey + '_' + index + '_' + fieldName + '">';
                html += '<input type="hidden" name="' + nameAttr + '" value="" class="goliath-video-value">';
                html += '<div class="goliath-video-preview" style="display:none">';
                html += '<span class="goliath-video-filename dashicons-before dashicons-video-alt3"></span>';
                html += '</div>';
                html += '<div class="goliath-video-actions">';
                html += '<button type="button" class="button goliath-video-upload">Choose Video</button> ';
                html += '<button type="button" class="button goliath-video-remove" style="display:none">Remove</button>';
                html += '</div>';
                html += '</div>';
            } else {
                html += '<input type="text" id="' + idAttr + '" name="' + nameAttr + '" value="" class="large-text">';
            }
            html += '</div>';
        });

        html += '</div>';
        return html;
    }

    /**
     * Re-index repeater rows after add/remove so array keys are sequential.
     */
    function reindexRepeater($repeater) {
        var optionKey = $repeater.data('option');

        $repeater.find('.goliath-repeater-items .goliath-repeater-row').each(function (i) {
            var $row = $(this);
            $row.attr('data-index', i);
            $row.find('.goliath-repeater-row-number').text('#' + (i + 1));

            $row.find('input, textarea, select').each(function () {
                var $el = $(this);
                var name = $el.attr('name');
                if (!name) return;
                var newName = name.replace(
                    /goliath_fields\[[^\]]+\]\[\d+\]/,
                    'goliath_fields[' + optionKey + '][' + i + ']'
                );
                $el.attr('name', newName);

                var id = $el.attr('id');
                if (id) {
                    var newId = id.replace(/_\d+_/, '_' + i + '_');
                    $el.attr('id', newId);
                    $row.find('label[for="' + id + '"]').attr('for', newId);
                }
            });
        });
    }

    /**
     * Escape HTML for safe insertion.
     */
    function escHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    /* ------------------------------------------------------------------ */
    /*  Repeater — drag-to-reorder (sortable)                             */
    /* ------------------------------------------------------------------ */

    $(function () {
        $('.goliath-repeater-items').sortable({
            handle: '.goliath-repeater-row-header',
            items: '> .goliath-repeater-row',
            axis: 'y',
            cursor: 'move',
            opacity: 0.65,
            placeholder: 'goliath-repeater-placeholder',
            update: function () {
                reindexRepeater($(this).closest('.goliath-repeater'));
            }
        });
    });

})(jQuery);
