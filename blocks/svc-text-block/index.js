import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';

registerBlockType( 'goliath/svc-text-block', {
    edit( { attributes, setAttributes } ) {
        const { bgColor, align, icon, heading, paragraphs, highlight, highlightPosition, tickItems, afterListText, ctaText, ctaUrl, statsBanner, statsBannerCtaText, statsBannerCtaUrl } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Layout">
                        <SelectControl label="Background" value={ bgColor } options={[ { label: 'White', value: 'white' }, { label: 'Grey', value: 'grey' } ]} onChange={ v => setAttributes({ bgColor: v }) } />
                        <SelectControl label="Alignment" value={ align } options={[ { label: 'Centre', value: 'center' }, { label: 'Left', value: 'left' } ]} onChange={ v => setAttributes({ align: v }) } />
                        <TextControl label="Icon URL" value={ icon } onChange={ v => setAttributes({ icon: v }) } />
                    </PanelBody>
                    <PanelBody title="Content">
                        <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ heading: v }) } />
                        <TextareaControl label="Highlight text (orange)" value={ highlight } onChange={ v => setAttributes({ highlight: v }) } />
                        <SelectControl label="Highlight position" value={ highlightPosition } options={[ { label: 'After first paragraph', value: 'after-first' }, { label: 'After list', value: 'after-list' } ]} onChange={ v => setAttributes({ highlightPosition: v }) } />
                        { paragraphs.map( ( p, i ) => (
                            <div key={ i } style={{ marginBottom: '8px' }}>
                                <TextareaControl label={ `Paragraph ${ i + 1 }` } value={ p } onChange={ v => { const n = [ ...paragraphs ]; n[i] = v; setAttributes({ paragraphs: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ paragraphs: paragraphs.filter( (_, idx) => idx !== i ) }) }>Remove</Button>
                            </div>
                        ) ) }
                        <Button isSecondary isSmall onClick={ () => setAttributes({ paragraphs: [ ...paragraphs, '' ] }) }>+ Add Paragraph</Button>
                    </PanelBody>
                    <PanelBody title="Tick List" initialOpen={ false }>
                        { tickItems.map( ( item, i ) => (
                            <div key={ i } style={{ marginBottom: '8px' }}>
                                <TextControl label={ `Item ${ i + 1 }` } value={ item } onChange={ v => { const n = [ ...tickItems ]; n[i] = v; setAttributes({ tickItems: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ tickItems: tickItems.filter( (_, idx) => idx !== i ) }) }>Remove</Button>
                            </div>
                        ) ) }
                        <Button isSecondary isSmall onClick={ () => setAttributes({ tickItems: [ ...tickItems, '' ] }) }>+ Add Item</Button>
                        <TextareaControl label="Text after list" value={ afterListText } onChange={ v => setAttributes({ afterListText: v }) } />
                    </PanelBody>
                    <PanelBody title="CTA Button" initialOpen={ false }>
                        <TextControl label="Button text" value={ ctaText } onChange={ v => setAttributes({ ctaText: v }) } />
                        <TextControl label="Button URL" value={ ctaUrl } onChange={ v => setAttributes({ ctaUrl: v }) } />
                    </PanelBody>
                    <PanelBody title="Stats Banner" initialOpen={ false }>
                        <TextControl label="Banner text" value={ statsBanner } onChange={ v => setAttributes({ statsBanner: v }) } />
                        <TextControl label="Banner CTA text" value={ statsBannerCtaText } onChange={ v => setAttributes({ statsBannerCtaText: v }) } />
                        <TextControl label="Banner CTA URL" value={ statsBannerCtaUrl } onChange={ v => setAttributes({ statsBannerCtaUrl: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ padding: '24px', background: bgColor === 'grey' ? '#f9fafb' : '#fff', border: '1px solid #e5e7eb' }}>
                    { heading && <h2 style={{ fontSize: '24px', fontWeight: 700 }}>{ heading }</h2> }
                    { paragraphs.map( ( p, i ) => <p key={ i } style={{ marginTop: '8px', color: '#364153' }}>{ p }</p> ) }
                    { highlight && <p style={{ color: '#ff5c00', fontWeight: 700, marginTop: '8px' }}>{ highlight }</p> }
                    { tickItems.length > 0 && <ul style={{ marginTop: '12px', columns: 2 }}>{ tickItems.map( ( t, i ) => <li key={ i }>✓ { t }</li> ) }</ul> }
                </div>
            </div>
        );
    },
    save() { return null; }
} );
