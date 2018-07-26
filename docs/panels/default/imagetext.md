The Image + Text panel is comprised of a title, text content, an image, and a CTA button.

The layout for this panel is a 2 column layout that places the image on the left or right side (your choice) and has that image stand alone in its column. The opposite side will contain, if provided, the title, text content, and CTA button. On smaller screens, this content will stack vertically placing the left side on top.

## Usage

A typical example for the usage of this panel would be if you wanted a large CTA on your page to help break up the content, or maybe you have an image that requires a longer story that a typical caption cannot convey.

## Fields

### `layout`
* location: `Settings`
* label: `Layout`
* type: `ImageSelect`
* options: `image-left`, `image-right`
* default: `image-left`

### `title`
* location: `Content`
* label: `Title`
* type: `Text`

### `description`
* location: `Content`
* label: `Description`
* type: `TextArea`
* richtext: `true`

### `image`
* location: `Content`
* label: `Image`
* type: `Image`
* size: `medium`

### `cta`
* location: `Content`
* label: `Call To Action Link`
* type: `Link`

## Components

### [Image](/components_docs/image)
* twig var: `{{ image }}`
* twig var type: `string`
* panel field: `image`

### [Content Block](/components_docs/content_block)
* twig var: `{{ content_block }}`
* twig var type: `string`
* component imports: `Button`, `Title`, `Text`

### [Button](/components_docs/button)
* used by: `Content Block`
* panel field: `cta`

### [Title](/components_docs/title)
* used by: `Content Block`
* panel field: `title`

### [Text](/components_docs/text)
* used by: `Content Block`
* panel field: `description`