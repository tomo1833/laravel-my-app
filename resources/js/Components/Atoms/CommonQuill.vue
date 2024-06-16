<script setup lang="ts">
import { ref, onMounted, watch, defineProps, defineEmits } from "vue";
import { QuillEditor, Quill } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const props = defineProps({
    content: String,
});

const emits = defineEmits(["update:content"]);

const quillEditorRef = ref(null);
const localContent = ref(props.content);

watch(
    () => props.content,
    (newContent) => {
        localContent.value = newContent;
    },
);

// アイコンの定義
const icons = Quill.import("ui/icons");
icons["image-url"] =
    '<svg viewbox="0 0 18 18"><rect class="ql-stroke" height="10" width="12" x="3" y="4"/><circle class="ql-fill" cx="6" cy="7" r="1"/><polyline class="ql-even ql-fill" points="10 8.5 11.5 11 14 6"/><line class="ql-even ql-stroke" x1="6" x2="8.5" y1="14" y2="10.5"/></svg>';

// ツールバーのオプション
const toolbarOptions = [
    ["bold", "italic", "underline", "strike"], // toggled buttons
    ["blockquote", "code-block"],
    [{ header: 1 }, { header: 2 }], // custom button values
    [{ list: "ordered" }, { list: "bullet" }],
    [{ script: "sub" }, { script: "super" }], // superscript/subscript
    [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
    [{ direction: "rtl" }], // text direction
    [{ size: ["small", false, "large", "huge"] }], // custom dropdown
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    [{ color: [] }, { background: [] }], // dropdown with defaults from theme
    [{ font: [] }],
    [{ align: [] }],
    ["image-url"],
    ["clean"], // remove formatting button
];

// カスタムハンドラの定義
const imageUrlHandler = () => {
    const url = prompt("Enter the image URL");
    if (url && quillEditorRef.value) {
        const quill = quillEditorRef.value.getQuill();
        const range = quill.getSelection();
        quill.insertEmbed(range.index, "image", url);
    }
};

// マウント時にツールバー要素にアクセスしてイベントリスナーを追加
onMounted(() => {
    const quill = quillEditorRef.value.getQuill();
    const toolbar = quill.getModule("toolbar").container;
    const button = toolbar.querySelector("button.ql-image-url");

    if (button) {
        button.addEventListener("click", imageUrlHandler);
    }
});

const onContentChange = (delta, oldDelta, source) => {
    const quill = quillEditorRef.value.getQuill();
    emits("update:content", quill.root.innerHTML);
};
</script>

<template>
    <QuillEditor
        theme="snow"
        :content="localContent"
        contentType="html"
        :toolbar="toolbarOptions"
        ref="quillEditorRef"
        @text-change="onContentChange"
    />
</template>
