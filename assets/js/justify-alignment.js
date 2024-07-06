wp.domReady(function () {
    // Register the new block style
    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'justify',
        label: 'Blocksatz',
        isDefault: false,
    });

    // Add the style to the block toolbar
    const el = wp.element.createElement;
    const justifyToolbarButton = wp.compose.createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            if (props.name !== 'core/paragraph') {
                return el(BlockEdit, props);
            }

            const { attributes, setAttributes } = props;
            const { className } = attributes;

            const hasJustifyClass = className && className.includes('has-text-align-justify');

            const onChangeAlignment = () => {
                const newClassName = hasJustifyClass
                    ? className.replace('has-text-align-justify', '').trim()
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
                            onClick: onChangeAlignment
                        })
                    )
                )
            );
        };
    }, 'justifyToolbarButton');

    wp.hooks.addFilter('editor.BlockEdit', 'djs_wallstreet_pro_extensions/justifyToolbarButton', justifyToolbarButton);
});
