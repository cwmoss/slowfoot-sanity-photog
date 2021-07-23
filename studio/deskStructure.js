import S from '@sanity/desk-tool/structure-builder'
import { MdMenu } from "react-icons/md"
import { GoBrowser as PageIcon, GoHome, GoSettings, GoPencil } from "react-icons/go"
// import { FaPencil } from "react-icons/fa"

//import blog from './src/structure/blog'
//import landingPages from './src/structure/landingPages'
//import PreviewIFrame from './src/components/previewIFrame'

const hiddenDocTypes = (listItem) =>
  !['route', 'navigationMenu', 'post', 'page', 'site_settings', 'xgallery_page', 'category'].includes(
    listItem.getId()
  )

export default () =>
  S.list()
    .title('Content')
    .items([
      /*
      S.documentListItem()
        .title('Frontpage')
        .schemaType('page')
        .icon(GoHome)
        .child(
          S.document()
            .schemaType('page')
            .documentId('frontpage')
            .views([S.view.form()])
        ),
      */
      // This returns an array of all the document types
      // defined in schema.js. We filter out those that we have
      // defined the structure above
      ...S.documentTypeListItems().filter(hiddenDocTypes),

      S.listItem()
        .title("Entwürfe")
        .icon(GoPencil)
        .child(
          S.documentList()
            .title("Entwürfe")
            .filter("_id in path('drafts.**')")
            .defaultOrdering([{ field: "_updatedAt", direction: "desc" }])
        ),

      S.listItem()
        .title('Settings')
        .icon(GoSettings)
        .child(
          S.document()
            .schemaType('site_settings')
            .documentId('site_settings')
        ),
        /*
      S.listItem()
        .title('Settings')
        .icon(GoSettings)
        .child(
          S.editor()
            .id('site_settings')
            .schemaType('site_settings')
            .documentId('site_settings')
        )*/
    ])
