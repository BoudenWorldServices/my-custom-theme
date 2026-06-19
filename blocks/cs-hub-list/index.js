import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit() {
        return (
            <div {...useBlockProps()}>
                <div style={{ border: '1px solid #e2e2e2', borderRadius: '4px', padding: '24px', background: '#fafafa' }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '8px' }}>
                        <span style={{ fontSize: '20px' }}>📋</span>
                        <strong style={{ fontSize: '15px', color: '#1e1e1e' }}>Case Studies Listing</strong>
                    </div>
                    <p style={{ fontSize: '13px', color: '#757575', margin: 0 }}>
                        This block automatically displays all published case studies with their image, challenge, solution, metrics, and a link to the full case study. Content updates dynamically when you add or edit case study posts.
                    </p>
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
