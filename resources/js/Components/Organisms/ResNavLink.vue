<script setup lang="ts">
import CommonResponsiveNavLink from "@/Components/Atoms/CommonResponsiveNavLink.vue";
</script>

<template>
    <CommonResponsiveNavLink routePath="dashboard" text="ダッシュボード" />
    <CommonResponsiveNavLink routePath="attendance.index" text="勤怠管理" />
    <CommonResponsiveNavLink routePath="education.index" text="教育管理" />
    <CommonResponsiveNavLink routePath="anime.index" text="アニメ" />
    <CommonResponsiveNavLink routePath="book.index" text="本" />
    <CommonResponsiveNavLink routePath="blog.index" text="ブログ" />
    <CommonResponsiveNavLink routePath="wiki.index" text="ウィキ" />
    <CommonResponsiveNavLink routePath="music.index" text="音楽" />
    <CommonResponsiveNavLink routePath="camera.index" text="カメラ" />
    <CommonResponsiveNavLink routePath="shougi.index" text="将棋" />
    <CommonResponsiveNavLink routePath="manga.index" text="漫画" />
    <CommonResponsiveNavLink routePath="movie.index" text="映画" />
</template>
