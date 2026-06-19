(() => {
    "use strict";

    const { registerBlockType } = window.wp.blocks;
    const { InspectorControls, useBlockProps, MediaUpload, MediaUploadCheck } = window.wp.blockEditor;
    const { PanelBody, TextControl, Button } = window.wp.components;
    const { createElement: el, Fragment } = window.wp.element;

    const metadata = JSON.parse('{"UU":"goliath/comp-warranty-overlay"}');

    registerBlockType(metadata.UU, {
        edit({ attributes, setAttributes }) {
            const { h3, item1, item2, item3, item4, image, imageId } = attributes;
            const blockProps = useBlockProps({ style: { background: "#f3f3f3", padding: "24px", position: "relative" } });
            const fallbackUrl = window.goliathCompWarrantyFallback || "";
            const displayUrl = image || fallbackUrl;

            const onSelectImage = (media) => {
                setAttributes({
                    image: media.url,
                    imageId: media.id,
                });
            };

            const onRemoveImage = () => {
                setAttributes({
                    image: "",
                    imageId: 0,
                });
            };

            return el(Fragment, null,
                el(InspectorControls, null,
                    el(PanelBody, { title: "Overlay Content", initialOpen: true },
                        el(TextControl, { label: "Heading (H3)", value: h3, onChange: (v) => setAttributes({ h3: v }) }),
                        el(TextControl, { label: "Bullet 1", value: item1, onChange: (v) => setAttributes({ item1: v }) }),
                        el(TextControl, { label: "Bullet 2", value: item2, onChange: (v) => setAttributes({ item2: v }) }),
                        el(TextControl, { label: "Bullet 3", value: item3, onChange: (v) => setAttributes({ item3: v }) }),
                        el(TextControl, { label: "Bullet 4", value: item4, onChange: (v) => setAttributes({ item4: v }) })
                    ),
                    el(PanelBody, { title: "Image", initialOpen: true },
                        el(MediaUploadCheck, null,
                            el(MediaUpload, {
                                onSelect: onSelectImage,
                                allowedTypes: ["image"],
                                value: imageId,
                                render: ({ open }) => el(Fragment, null,
                                    displayUrl
                                        ? el("div", { style: { marginBottom: "12px" } },
                                            el("img", { src: displayUrl, alt: "", style: { width: "100%", height: "auto", maxHeight: "180px", objectFit: "cover", borderRadius: "4px" } }),
                                            el("div", { style: { marginTop: "8px", display: "flex", gap: "8px" } },
                                                el(Button, { variant: "secondary", onClick: open }, image ? "Replace image" : "Change image"),
                                                image ? el(Button, { isDestructive: true, variant: "link", onClick: onRemoveImage }, "Remove") : null
                                            )
                                        )
                                        : el(Button, { variant: "secondary", onClick: open }, "Upload image")
                                )
                            })
                        )
                    )
                ),
                el("div", blockProps,
                    el("div", {
                        style: { background: "#ccc", height: "200px", marginBottom: "16px", display: "flex", alignItems: "center", justifyContent: "center", color: "#666", overflow: "hidden" }
                    },
                        displayUrl
                            ? el("img", { src: displayUrl, alt: "", style: { width: "100%", height: "100%", objectFit: "cover" } })
                            : el(MediaUploadCheck, null,
                                el(MediaUpload, {
                                    onSelect: onSelectImage,
                                    allowedTypes: ["image"],
                                    value: imageId,
                                    render: ({ open }) => el(Button, { variant: "secondary", onClick: open, style: { margin: "auto" } }, "Upload section image")
                                })
                            )
                    ),
                    el("div", { style: { background: "#ff5c00", padding: "24px" } },
                        el("p", { style: { color: "#fff", fontWeight: 700, fontSize: "16px", margin: "0 0 8px" } }, h3),
                        [item1, item2, item3, item4].filter(Boolean).map((item, i) =>
                            el("p", { key: i, style: { color: "#fff", fontSize: "13px", margin: "4px 0" } }, "\u2713 ", item)
                        )
                    )
                )
            );
        },
        save: () => null,
    });
})();
