<script setup lang="ts">
import CommonResNaviLink from "@/Components/Atoms/CommonResNaviLink.vue";
</script>

<template>
    <CommonResNaviLink routePath="dashboard" text="ダッシュボード" />
    <CommonResNaviLink routePath="todo.index" text="todo" />

    <CommonResNaviLink routePath="attendance.index" text="勤怠管理" />
    <CommonResNaviLink routePath="events.index" text="スケジュール" />

    <CommonResNaviLink routePath="education.index" text="教育管理" />
    <CommonResNaviLink routePath="udemy.index" text="udemy" />

    <CommonResNaviLink routePath="anime.index" text="アニメ" />
    <CommonResNaviLink routePath="book.index" text="本" />
    <CommonResNaviLink routePath="blog.index" text="ブログ" />
    <CommonResNaviLink routePath="wiki.index" text="ウィキ" />
    <CommonResNaviLink routePath="music.index" text="音楽" />
    <CommonResNaviLink routePath="camera.index" text="カメラ" />
    <CommonResNaviLink routePath="shougi.index" text="将棋" />
    <CommonResNaviLink routePath="manga.index" text="漫画" />
    <CommonResNaviLink routePath="movie.index" text="映画" />
    <CommonResNaviLink routePath="novel.index" text="なろう小説" />
    <CommonResNaviLink routePath="maxim.index" text="名言" />

    <CommonResNaviLink routePath="educationLarge.index" text="教育大項目" />
    <CommonResNaviLink routePath="educationMiddle.index" text="教育中項目" />
    <CommonResNaviLink routePath="educationSmall.index" text="教育小項目" />
    <CommonResNaviLink routePath="animeGenres.index" text="アニメジャンル" />
</template>
