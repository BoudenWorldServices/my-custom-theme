import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from './block.json';

registerBlockType(metadata.name, {
    edit() {
        const blockProps = useBlockProps();
        return (
            <div {...blockProps}>
                <div style={{ padding: '24px', background: '#fafafa', border: '1px dashed #ccc', textAlign: 'center' }}>
                    <p style={{ margin: 0, fontWeight: 'bold' }}>Related Videos</p>
                    <p style={{ margin: '4px 0 0', fontSize: '13px', color: '#666' }}>
                        Automatically displays up to 3 other video posts (server-rendered).
                    </p>
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
