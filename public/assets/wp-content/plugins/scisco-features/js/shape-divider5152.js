( function( $ ) {
    "use strict";
    $( window ).on( 'elementor/frontend/init', function() {
          var EF = elementorFrontend,
              EM = elementorModules;
  
          var ExtensionHandler = EM.frontend.handlers.Base.extend({
              onInit: function() {
                  EM.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                  this.initDividers();
              },
              getConfig: function(key) {
                  return this.getElementSettings('scisco_shape_divider_' + key);
              },
              initDividers: function() {
                ['preserveAspectRatio', 'viewBox'].forEach(function(k) {
                    $.attrHooks[k.toLowerCase()] = {
                      set: function(el, value) {
                        el.setAttribute(k, value);
                        return true;
                      },
                      get: function(el) {
                        return el.getAttribute(k);
                      },
                    };
                });
                var dataid = $(this).data('id'),
                    top_enabled = this.getConfig('top') || 'none',
                    bottom_enabled = this.getConfig('bottom') || 'none',
                    top_color = this.getConfig('top_color') || '#ffffff',
                    bottom_color = this.getConfig('bottom_color') || '#ffffff',
                    top_width = this.getConfig('top_width.size') || 100,
                    bottom_width = this.getConfig('bottom_width.size') || 100,
                    top_height = this.getConfig('top_height.size'),
                    bottom_height = this.getConfig('bottom_height.size'),
                    top_flip = this.getConfig('top_flip'),
                    bottom_flip = this.getConfig('bottom_flip'),
                    top_zindex = this.getConfig('top_zindex') || -1,
                    bottom_zindex = this.getConfig('bottom_zindex') || -1,
                    top_custom = this.getConfig('top_custom'),
                    bottom_custom = this.getConfig('bottom_custom');

                    if (top_height) {
                        top_height = top_height + 'px';
                    } else {
                        top_height = 'auto';
                    }

                    if (bottom_height) {
                        bottom_height = bottom_height + 'px';
                    } else {
                        bottom_height = 'auto';
                    }

                    if (top_flip) {
                        top_flip = ' transform: rotateY(180deg);';
                    } else {
                        top_flip = '';
                    }

                    if (bottom_flip) {
                        bottom_flip = ' transform: rotateY(180deg);';
                    } else {
                        bottom_flip = '';
                    }
  
                    this.$element.each(function () {
                    var dataid = $(this).data('id');
                    if (top_enabled === 'none') {
                        $(this).find('#scisco-shape-divider-top-' + dataid).remove();
                    } else if (top_enabled === 'custom') {
                        $(this).prepend('<div id="scisco-shape-divider-top-' + dataid + '" style="position:absolute;top:-1px;left:0;right:0;width:100%;overflow:hidden;z-index:' + top_zindex + ';' + top_flip + '"></div><style>#scisco-shape-divider-top-' + dataid + ' svg {position:relative;display:block;transform:translateX(-50%);left:50%;width:' + top_width + '%;height:' + top_height + ';}#scisco-shape-divider-top-' + dataid + ' svg * {fill:' + top_color + ';}</style>');
                        $(this).find('#scisco-shape-divider-top-' + dataid).load( top_custom, function() {
                            $(this).find('svg').attr('preserveAspectRatio', 'none');
                        });
                    } else {
                        $(this).prepend('<div id="scisco-shape-divider-top-' + dataid + '" style="position:absolute;top:-1px;left:0;right:0;width:100%;overflow:hidden;z-index:' + top_zindex + ';' + top_flip + '"></div><style>#scisco-shape-divider-top-' + dataid + ' svg {position:relative;display:block;transform:translateX(-50%);left:50%;width:' + top_width + '%;height:' + top_height + ';}#scisco-shape-divider-top-' + dataid + ' svg * {fill:' + top_color + ';}</style>');
                        $(this).find('#scisco-shape-divider-top-' + dataid).load( SciscoDividerParams.sciscoPluginURL + 'dividers/' + top_enabled + '-top.svg', function() {
                            $(this).find('svg').attr('preserveAspectRatio', 'none');
                        });
                    }
                    if (bottom_enabled === 'none') {
                        $(this).find('#scisco-shape-divider-bottom-' + dataid).remove();
                    } else if (bottom_enabled === 'custom') {
                        $(this).append('<div id="scisco-shape-divider-bottom-' + dataid + '" style="position:absolute;bottom:-1px;left:0;right:0;width:100%;overflow:hidden;z-index:' + bottom_zindex + ';' + bottom_flip + '"></div><style>#scisco-shape-divider-bottom-' + dataid + ' svg {position:relative;display:block;transform:translateX(-50%);left:50%;width:' + bottom_width + '%;height:' + bottom_height + ';}#scisco-shape-divider-bottom-' + dataid + ' svg * {fill:' + bottom_color + ';}</style>');
                        $(this).find('#scisco-shape-divider-bottom-' + dataid).load( bottom_custom, function() {
                            $(this).find('svg').attr('preserveAspectRatio', 'none');
                        });
                    } else {
                        $(this).append('<div id="scisco-shape-divider-bottom-' + dataid + '" style="position:absolute;bottom:-1px;left:0;right:0;width:100%;overflow:hidden;z-index:' + bottom_zindex + ';' + bottom_flip + '"></div><style>#scisco-shape-divider-bottom-' + dataid + ' svg {position:relative;display:block;transform:translateX(-50%);left:50%;width:' + bottom_width + '%;height:' + bottom_height + ';}#scisco-shape-divider-bottom-' + dataid + ' svg * {fill:' + bottom_color + ';}</style>');
                        $(this).find('#scisco-shape-divider-bottom-' + dataid).load( SciscoDividerParams.sciscoPluginURL + 'dividers/' + bottom_enabled + '-bottom.svg', function() {
                            $(this).find('svg').attr('preserveAspectRatio', 'none');
                        });
                    }
                });
              }
          });
          EF.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
              EF.elementsHandler.addHandler( ExtensionHandler, { $element: $scope });
          });
        });
  } )( jQuery );
  