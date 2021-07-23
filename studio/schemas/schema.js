// First, we must import the schema creator
import createSchema from 'part:@sanity/base/schema-creator'

// Then import schema types from any plugins that might expose them
import schemaTypes from 'all:part:@sanity/base/schema-type'

import gallery_page from './docs/gallery_page'
import site_settings from './docs/site_settings'
import navigation from './docs/navigation'

import gallery from './obj/gallery'
import keyval from './obj/keyval'
import main_image from './obj/main_image'
import opengraph from './obj/opengraph'
import link from './obj/link'
import nav_item from './obj/nav_item'

// Then we give our schema to the builder and provide the result to Sanity
export default createSchema({
  // We name our schema
  name: 'default',
  // Then proceed to concatenate our document type
  // to the ones provided by any plugins that are installed
  types: schemaTypes.concat([
    gallery_page,
    site_settings,
    navigation,

    gallery,
    keyval,
    main_image,
    opengraph,
    nav_item,
    link
  ])
})
