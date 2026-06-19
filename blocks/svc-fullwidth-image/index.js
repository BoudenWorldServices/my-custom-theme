import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

registerBlockType( 'goliath/svc-fullwidth-image', {
    edit( { attributes, setAttributes } ) {
        const { image, imageAlt } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Image">
                        <TextControl label="Image URL" value={ image } onChange={ v => setAttributes({ image: v }) } />
                        <TextControl label="Alt text" value={ imageAlt } onChange={ v => setAttributes({ imageAlt: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ height: '180px', background: '#e5e7eb', overflow: 'hidden' }}>
                    { image ? <img src={image} alt={imageAlt} style={{ width: '100%', height: '100%', objectFit: 'cover' }} /> : <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#888' }}>Full-width image</span> }
                </div>
            </div>
        );
    },
    save() { return null; }
} );
