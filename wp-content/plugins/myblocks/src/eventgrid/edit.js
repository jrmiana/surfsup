import { __ } from '@wordpress/i18n';
import './editor.scss';

import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
  PanelBody,
  TextControl,
  SelectControl
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { limit, category, order } = attributes;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__('Event Grid Settings', 'event-grid')} initialOpen={true}>
          <TextControl
            label={__('Limit', 'event-grid')}
            type="number"
            value={limit}
            onChange={(val) => setAttributes({ limit: parseInt(val) || 0 })}
            min={1}
          />
          <TextControl
            label={__('Category Slug (optional)', 'event-grid')}
            value={category}
            onChange={(val) => setAttributes({ category: val })}
          />
          <SelectControl
            label={__('Order', 'event-grid')}
            value={order}
            options={[
              { label: 'Descending', value: 'DESC' },
              { label: 'Ascending', value: 'ASC' }
            ]}
            onChange={(val) => setAttributes({ order: val })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...useBlockProps()}>
        <p>{__('Event Grid will be shown on the front end.', 'event-grid')}</p>
      </div>
    </>
  );
}
