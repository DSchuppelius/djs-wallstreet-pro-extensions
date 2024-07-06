/*
 * Created on   : Fri Jul 5 2024
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : justify-alignment.js
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
wp.domReady(function () {
    // Register the new block style
    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'justify',
        label: 'Blocksatz',
        isDefault: false,
    });

    // Add the style to the block toolbar
    const el = wp.element.createElement;
    const { useState, useEffect } = wp.element;

    const justifyToolbarButton = wp.compose.createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            if (props.name !== 'core/paragraph') {
                return el(BlockEdit, props);
            }

            const { attributes, setAttributes } = props;
            const { className = '' } = attributes; // Default to empty string if className is undefined

            // State to track justify class
            const [hasJustifyClass, setHasJustifyClass] = useState(className.includes('has-text-align-justify'));

            useEffect(() => {
                const getAllClasses = () => {
                    return className.split(' ').filter(Boolean);
                };

                const hasClass = getAllClasses().includes('has-text-align-justify');
                setHasJustifyClass(hasClass);
            }, [className]);

            const hasOtherJustifyClasses = () => {
                const paragraph = document.querySelector(`[data-block="${props.clientId}"]`);
                if (paragraph) {
                    const allClasses = Array.from(paragraph.classList);
                    const hasParagraphJustifyClass = allClasses.includes('has-text-align-justify');
                    return hasParagraphJustifyClass && !hasJustifyClass;
                }
                return false;
            };

            const onChangeAlignment = () => {
                const newClassName = hasJustifyClass
                    ? className.replace(/\bhas-text-align-justify\b/, '').trim()
                    : (className ? className + ' has-text-align-justify' : 'has-text-align-justify');

                setAttributes({ className: newClassName });
            };

            return el(wp.element.Fragment, {},
                el(BlockEdit, props),
                el(wp.blockEditor.BlockControls, {},
                    el(wp.components.ToolbarGroup, {},
                        el(wp.components.ToolbarButton, {
                            icon: 'editor-justify',
                            label: 'Blocksatz',
                            isActive: hasJustifyClass,
                            isDisabled: hasOtherJustifyClasses(),
                            onClick: () => {
                                onChangeAlignment();
                            }
                        })
                    )
                )
            );
        };
    }, 'justifyToolbarButton');

    wp.hooks.addFilter('editor.BlockEdit', 'djs_wallstreet_pro_extensions/justifyToolbarButton', justifyToolbarButton);
});
