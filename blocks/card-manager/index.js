/**
 * Card Manager Block
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, RichText, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './index.css';

registerBlockType( metadata.name, {
	...metadata,
	edit: ( { attributes, setAttributes } ) => {
		const { heading, headingLevel, columns } = attributes;
		const blockProps = useBlockProps( {
			className: 'card-manager-wrapper',
			'data-columns': columns,
		} );

		const HeadingTag = `h${ headingLevel }`;

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Card Manager Settings', 'kurv-knowledgebase-2026' ) }>
						<RangeControl
							label={ __( 'Number of Columns', 'kurv-knowledgebase-2026' ) }
							value={ columns }
							onChange={ ( value ) => setAttributes( { columns: value } ) }
							min={ 1 }
							max={ 4 }
						/>
						<SelectControl
							label={ __( 'Heading Level', 'kurv-knowledgebase-2026' ) }
							value={ headingLevel }
							options={ [
								{ label: 'H1', value: 1 },
								{ label: 'H2', value: 2 },
								{ label: 'H3', value: 3 },
								{ label: 'H4', value: 4 },
								{ label: 'H5', value: 5 },
								{ label: 'H6', value: 6 },
							] }
							onChange={ ( value ) => setAttributes( { headingLevel: parseInt( value ) } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<HeadingTag className="card-manager-heading">
						<span className="heading-line heading-line-top"></span>
						<RichText
							tagName="span"
							className="heading-text"
							value={ heading }
							onChange={ ( value ) => setAttributes( { heading: value } ) }
							placeholder={ __( 'Enter heading...', 'kurv-knowledgebase-2026' ) }
						/>
						<span className="heading-line heading-line-bottom"></span>
					</HeadingTag>
					
					<div className="card-manager-container">
						<InnerBlocks
							allowedBlocks={ [ 'kurv-knowledgebase-2026/card-item' ] }
							template={ [] }
							orientation="horizontal"
						/>
					</div>
				</div>
			</>
		);
	},
	save: () => {
		return <InnerBlocks.Content />;
	},
} );
