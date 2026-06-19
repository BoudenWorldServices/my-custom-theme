import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

registerBlockType( 'goliath/svc-image-pair', {
    edit( { attributes, setAttributes } ) {
        const { image1, image1Alt, image2, image2Alt, introText } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Images">
                        <TextareaControl label="Intro text (optional)" value={ introText } onChange={ v => setAttributes({ introText: v }) } />
                        <TextControl label="Image 1 URL" value={ image1 } onChange={ v => setAttributes({ image1: v }) } />
                        <TextControl label="Image 1 alt" value={ image1Alt } onChange={ v => setAttributes({ image1Alt: v }) } />
                        <TextControl label="Image 2 URL" value={ image2 } onChange={ v => setAttributes({ image2: v }) } />
                        <TextControl label="Image 2 alt" value={ image2Alt } onChange={ v => setAttributes({ image2Alt: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ display: 'flex', gap: '12px', padding: '20px', background: '#f9fafb', border: '1px solid #e5e7eb' }}>
                    <div style={{ flex: 1, height: '140px', background: '#ddd', overflow: 'hidden' }}>
                        { image1 ? <img src={image1} alt={image1Alt} style={{ width: '100%', height: '100%', objectFit: 'cover' }} /> : <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#888' }}>Image 1</span> }
                    </div>
                    <div style={{ flex: 1, height: '140px', background: '#ddd', overflow: 'hidden' }}>
                        { image2 ? <img src={image2} alt={image2Alt} style={{ width: '100%', height: '100%', objectFit: 'cover' }} /> : <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#888' }}>Image 2</span> }
                    </div>
                </div>
            </div>
        );
    },
    save() { return null; }
} );
