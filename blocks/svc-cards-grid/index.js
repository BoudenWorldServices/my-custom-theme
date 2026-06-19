import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, RangeControl, Button } from '@wordpress/components';

registerBlockType( 'goliath/svc-cards-grid', {
    edit( { attributes, setAttributes } ) {
        const { heading, introParagraphs, columns, cards, darkCallout, darkCalloutHighlight, afterText } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Content">
                        <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ heading: v }) } />
                        { introParagraphs.map( (p, i) => (
                            <div key={i} style={{ marginBottom: '8px' }}>
                                <TextareaControl label={ `Intro paragraph ${i+1}` } value={p} onChange={ v => { const n = [...introParagraphs]; n[i] = v; setAttributes({ introParagraphs: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ introParagraphs: introParagraphs.filter((_,idx) => idx !== i) }) }>Remove</Button>
                            </div>
                        ))}
                        <Button isSecondary isSmall onClick={ () => setAttributes({ introParagraphs: [...introParagraphs, ''] }) }>+ Add Intro</Button>
                        <RangeControl label="Columns" value={ columns } onChange={ v => setAttributes({ columns: v }) } min={2} max={4} />
                    </PanelBody>
                    <PanelBody title="Cards">
                        { cards.map( (card, i) => (
                            <div key={i} style={{ marginBottom: '12px', padding: '8px', border: '1px solid #ddd' }}>
                                <TextControl label="Title" value={ card.title || '' } onChange={ v => { const n = [...cards]; n[i] = {...n[i], title: v}; setAttributes({ cards: n }); } } />
                                <TextControl label="Description" value={ card.desc || '' } onChange={ v => { const n = [...cards]; n[i] = {...n[i], desc: v}; setAttributes({ cards: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ cards: cards.filter((_,idx) => idx !== i) }) }>Remove Card</Button>
                            </div>
                        ))}
                        <Button isSecondary isSmall onClick={ () => setAttributes({ cards: [...cards, { title: '', desc: '' }] }) }>+ Add Card</Button>
                    </PanelBody>
                    <PanelBody title="Dark Callout" initialOpen={false}>
                        <TextareaControl label="Callout text" value={ darkCallout } onChange={ v => setAttributes({ darkCallout: v }) } />
                        <TextControl label="Highlight (orange)" value={ darkCalloutHighlight } onChange={ v => setAttributes({ darkCalloutHighlight: v }) } />
                        <TextareaControl label="After text" value={ afterText } onChange={ v => setAttributes({ afterText: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ padding: '20px', border: '1px solid #e5e7eb' }}>
                    { heading && <h2 style={{ fontSize: '22px', fontWeight: 700 }}>{ heading }</h2> }
                    <div style={{ display: 'grid', gridTemplateColumns: `repeat(${columns}, 1fr)`, gap: '12px', marginTop: '12px' }}>
                        { cards.map( (c, i) => <div key={i} style={{ background: '#f9fafb', padding: '12px' }}><strong>{c.title}</strong><br/><small>{c.desc}</small></div> ) }
                    </div>
                </div>
            </div>
        );
    },
    save() { return null; }
} );
