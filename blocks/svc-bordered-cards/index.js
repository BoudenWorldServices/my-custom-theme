import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

registerBlockType( 'goliath/svc-bordered-cards', {
    edit( { attributes, setAttributes } ) {
        const { sectionHeading, sectionDesc, card1Heading, card1Desc, card2Heading, card2Desc } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Section">
                        <TextControl label="Section heading" value={ sectionHeading } onChange={ v => setAttributes({ sectionHeading: v }) } />
                        <TextareaControl label="Section description" value={ sectionDesc } onChange={ v => setAttributes({ sectionDesc: v }) } />
                    </PanelBody>
                    <PanelBody title="Card 1">
                        <TextControl label="Heading" value={ card1Heading } onChange={ v => setAttributes({ card1Heading: v }) } />
                        <TextareaControl label="Description" value={ card1Desc } onChange={ v => setAttributes({ card1Desc: v }) } />
                    </PanelBody>
                    <PanelBody title="Card 2">
                        <TextControl label="Heading" value={ card2Heading } onChange={ v => setAttributes({ card2Heading: v }) } />
                        <TextareaControl label="Description" value={ card2Desc } onChange={ v => setAttributes({ card2Desc: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ padding: '20px', background: '#f9fafb', border: '1px solid #e5e7eb' }}>
                    { sectionHeading && <h2 style={{ textAlign: 'center', fontSize: '22px', fontWeight: 700 }}>{ sectionHeading }</h2> }
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '12px', marginTop: '16px' }}>
                        <div style={{ border: '2px solid #ff5c00', padding: '16px', background: '#fff' }}><strong>{ card1Heading }</strong><p>{ card1Desc }</p></div>
                        <div style={{ border: '2px solid #ff5c00', padding: '16px', background: '#fff' }}><strong>{ card2Heading }</strong><p>{ card2Desc }</p></div>
                    </div>
                </div>
            </div>
        );
    },
    save() { return null; }
} );
