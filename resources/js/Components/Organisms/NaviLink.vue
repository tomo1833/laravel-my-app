<script setup lang="ts">
import CommonNaviLink from "@/Components/Atoms/CommonNaviLink.vue";
</script>

<template>
    <CommonNaviLink routePath="dashboard" text="ダッシュボード" />
    <CommonNaviLink routePath="attendance.index" text="勤怠管理" />
    <CommonNaviLink routePath="education.index" text="教育管理" />
    <CommonNaviLink routePath="anime.index" text="アニメ" />
    <CommonNaviLink routePath="book.index" text="本" />
    <CommonNaviLink routePath="blog.index" text="ブログ" />
    <CommonNaviLink routePath="wiki.index" text="ウィキ" />
    <CommonNaviLink routePath="music.index" text="音楽" />
    <CommonNaviLink routePath="camera.index" text="カメラ" />
    <CommonNaviLink routePath="shougi.index" text="将棋" />
    <CommonNaviLink routePath="manga.index" text="漫画" />
    <CommonNaviLink routePath="movie.index" text="映画" />
    <CommonNaviLink routePath="educationLarge.index" text="教育大項目" />
</template>
