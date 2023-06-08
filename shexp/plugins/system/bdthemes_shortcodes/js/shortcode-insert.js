function suInsertShortcode(text) {
    "use strict";
    // if (document.getElementById("jform_articletext") != null) {
    //     jInsertEditorText(text, "jform_articletext");
    // }
    // if (document.getElementById("editor") != null) {
    //     jInsertEditorText(text, editor);
    // }
    // if (document.getElementById("jform_description") != null) {
    //     jInsertEditorText(text, "jform_description");
    // }
    // if (document.getElementById("jform_content") != null) {
    //     jInsertEditorText(text, "jform_content");
    // }
    // if (document.getElementById("art_fulltext") != null) {
    //   jInsertEditorText(text, "art_fulltext");
    // }
    // if (document.getElementById("write_content") != null) {
    //   jInsertEditorText(text, "write_content");
    // }
    // if (document.getElementById("dc_reply_content") != null) {
    //   jInsertEditorText(text, "dc_reply_content");
    // }
    
    
    //Editor Content
    if(document.getElementById("jform_articletext") != null) {
        jInsertEditorText(text, "jform_articletext");
    }
    if(document.getElementById("jform_description") != null) {
        jInsertEditorText(text, "jform_description");
    }
    
    //Editor K2
    if(document.getElementById("description") != null) {
        jInsertEditorText(text, "description");
    }
    if(document.getElementById("text") != null) {
        jInsertEditorText(text, "text");
    }
    
    //Editor VirtueMart 
    if(document.getElementById("category_description") != null) {
        jInsertEditorText(text, "category_description");
    }
    if(document.getElementById("product_desc") != null) {
        jInsertEditorText(text, "product_desc");
    }
    
    //Editor Contact
    if(document.getElementById("jform_misc") != null) {
        jInsertEditorText(text, "jform_misc");
    }
    
    //Editor Easyblog
    // if(document.getElementById("write_content") != null) {
    //     jInsertEditorText(text, "write_content");
    // }
    
    //Editor Joomshoping
    if(document.getElementById("description1") != null) {
        jInsertEditorText(text, "description1");
    }

    SqueezeBox.close(); 
}