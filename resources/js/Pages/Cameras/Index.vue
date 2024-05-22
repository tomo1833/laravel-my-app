<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import * as THREE from "three";

const videoRef = ref<HTMLVideoElement | null>(null);
const canvasRef = ref<HTMLCanvasElement | null>(null);
const containerRef = ref(null);
let contextRef = ref<CanvasRenderingContext2D | null>(null);
let animationFrameId = ref(null);
let particles = [];

const startCamera = async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: true,
        });
        if (videoRef.value) {
            videoRef.value.srcObject = stream;
            updateCanvas();
        }
    } catch (error) {
        console.error("カメラのアクセスに失敗しました:", error);
    }
};

const updateCanvas = () => {
    if (videoRef.value && canvasRef.value && contextRef.value) {
        const ctx = contextRef.value;
        const video = videoRef.value;

        const render = () => {
            ctx.drawImage(
                video,
                0,
                0,
                canvasRef.value.width,
                canvasRef.value.height,
            );
            updateParticles(ctx);
            animationFrameId.value = requestAnimationFrame(render);
        };

        render();
    }
};

const launchFirework = () => {
    const x = Math.random() * canvasRef.value.width;
    const y = canvasRef.value.height;
    const color = `hsl(${Math.random() * 360}, 100%, 50%)`;
    for (let i = 0; i < 100; i++) {
        particles.push({
            x: x,
            y: y,
            vx: (Math.random() - 0.5) * 2,
            vy: Math.random() * -3 - 4,
            alpha: 1,
            color: color,
        });
    }
};

const updateParticles = (ctx) => {
    for (let i = particles.length - 1; i >= 0; i--) {
        const p = particles[i];
        p.vy += 0.05; // gravity
        p.x += p.vx;
        p.y += p.vy;
        p.alpha -= 0.005; // fade out

        if (p.alpha <= 0) {
            particles.splice(i, 1);
            continue;
        }

        ctx.beginPath();
        ctx.arc(p.x, p.y, 3, 0, Math.PI * 2);
        ctx.fillStyle = p.color;
        ctx.globalAlpha = p.alpha;
        ctx.fill();
    }
};

// 3D scene setup
let scene, camera, renderer, sphere;
const initThreeJS = () => {
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000,
    );
    renderer = new THREE.WebGLRenderer({ alpha: true }); // 透明背景を保証
    renderer.setSize(window.innerWidth, window.innerHeight);
    containerRef.value.appendChild(renderer.domElement);

    const geometry = new THREE.SphereGeometry(1, 32, 32);
    const material = new THREE.MeshBasicMaterial({
        color: 0xff0000,
        wireframe: true,
    });
    sphere = new THREE.Mesh(geometry, material);
    scene.add(sphere);

    camera.position.z = 5; // カメラの位置を調整

    const animate = () => {
        requestAnimationFrame(animate);
        sphere.rotation.x += 0.01;
        sphere.rotation.y += 0.01;
        renderer.render(scene, camera);
    };

    animate();
};

onMounted(() => {
    if (canvasRef.value) {
        contextRef.value = canvasRef.value.getContext("2d");
    }
    if (containerRef.value) {
        // コンテナが存在することを確認
        initThreeJS();
    } else {
        console.error("3Dコンテンツのコンテナが見つかりません。");
    }
});

onUnmounted(() => {
    if (animationFrameId.value) {
        cancelAnimationFrame(animationFrameId.value);
    }
    if (videoRef.value && videoRef.value.srcObject) {
        const stream = videoRef.value.srcObject as MediaStream;
        const tracks = stream.getTracks();
        tracks.forEach((track) => track.stop());
        videoRef.value.srcObject = null;
    }
});
</script>

<template>
    <Head title="カメラ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                カメラ
            </h2>
        </template>
        <div class="flex items-center justify-between mb-4 bg-green-300"></div>

        <div class="flex flex-col items-center justify-between mb-4">
            <video
                ref="videoRef"
                width="640"
                height="480"
                autoplay
                style="display: none"
            ></video>
            <canvas ref="canvasRef" width="640" height="480">-</canvas>

            <button
                @click="startCamera"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                カメラ起動
            </button>
            <button
                @click="launchFirework"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                花火をあげる
            </button>
        </div>
    </AuthenticatedLayout>
</template>
