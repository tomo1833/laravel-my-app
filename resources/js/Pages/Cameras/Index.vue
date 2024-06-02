<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const videoRef = ref<HTMLVideoElement | null>(null);
const canvasRef = ref<HTMLCanvasElement | null>(null);
const contextRef = ref<CanvasRenderingContext2D | null>(null);
const animationFrameId = ref<number | null>(null);
const effect = ref<string>("none");
let particles: Array<{
    x: number;
    y: number;
    vx: number;
    vy: number;
    alpha: number;
    color: string;
}> = [];

const effects = {
    grayscale: (data: Uint8ClampedArray) => {
        for (let i = 0; i < data.length; i += 4) {
            const gray =
                0.3 * data[i] + 0.59 * data[i + 1] + 0.11 * data[i + 2];
            data[i] = data[i + 1] = data[i + 2] = gray;
        }
    },
    sepia: (data: Uint8ClampedArray) => {
        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];
            data[i] = r * 0.393 + g * 0.769 + b * 0.189;
            data[i + 1] = r * 0.349 + g * 0.686 + b * 0.168;
            data[i + 2] = r * 0.272 + g * 0.534 + b * 0.131;
        }
    },
    invert: (data: Uint8ClampedArray) => {
        for (let i = 0; i < data.length; i += 4) {
            data[i] = 255 - data[i];
            data[i + 1] = 255 - data[i + 1];
            data[i + 2] = 255 - data[i + 2];
        }
    },
    pixelate: (data: Uint8ClampedArray, width: number, height: number) => {
        const pixelSize = 10;
        for (let y = 0; y < height; y += pixelSize) {
            for (let x = 0; x < width; x += pixelSize) {
                const i = (y * width + x) * 4;
                const r = data[i];
                const g = data[i + 1];
                const b = data[i + 2];
                for (let n = 0; n < pixelSize; n++) {
                    for (let m = 0; m < pixelSize; m++) {
                        if (x + m < width && y + n < height) {
                            const j = ((y + n) * width + (x + m)) * 4;
                            data[j] = r;
                            data[j + 1] = g;
                            data[j + 2] = b;
                        }
                    }
                }
            }
        }
    },
    blur: (data: Uint8ClampedArray, width: number, height: number) => {
        const kernel = [
            [1 / 16, 2 / 16, 1 / 16],
            [2 / 16, 4 / 16, 2 / 16],
            [1 / 16, 2 / 16, 1 / 16],
        ];
        const copy = new Uint8ClampedArray(data);
        for (let y = 1; y < height - 1; y++) {
            for (let x = 1; x < width - 1; x++) {
                let r = 0,
                    g = 0,
                    b = 0;
                for (let ky = -1; ky <= 1; ky++) {
                    for (let kx = -1; kx <= 1; kx++) {
                        const i = ((y + ky) * width + (x + kx)) * 4;
                        r += copy[i] * kernel[ky + 1][kx + 1];
                        g += copy[i + 1] * kernel[ky + 1][kx + 1];
                        b += copy[i + 2] * kernel[ky + 1][kx + 1];
                    }
                }
                const j = (y * width + x) * 4;
                data[j] = r;
                data[j + 1] = g;
                data[j + 2] = b;
            }
        }
    },
    neon: (data: Uint8ClampedArray) => {
        for (let i = 0; i < data.length; i += 4) {
            data[i] = data[i] > 128 ? 255 : 0;
            data[i + 1] = data[i + 1] > 128 ? 255 : 0;
            data[i + 2] = data[i + 2] > 128 ? 255 : 0;
        }
    },
};

// エフェクトを設定するメソッド
const setEffect = (newEffect: string) => {
    effect.value = newEffect;
};

// カメラの起動
const startCamera = async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: {
                width: { ideal: 480 },
                height: { ideal: 640 },
            },
        });
        if (videoRef.value) {
            videoRef.value.srcObject = stream;
            videoRef.value.play();
            updateCanvas();
        }
    } catch (error) {
        console.error("カメラのアクセスに失敗しました:", error);
    }
};

// カメラの停止
const stopCamera = () => {
    if (videoRef.value && videoRef.value.srcObject) {
        const stream = videoRef.value.srcObject as MediaStream;
        const tracks = stream.getTracks();
        tracks.forEach((track) => track.stop());
        videoRef.value.srcObject = null;
    }
};

// エフェクトの適用
const applyEffect = (imageData: ImageData) => {
    const data = imageData.data;
    const width = imageData.width;
    const height = imageData.height;
    if (effect.value in effects) {
        effects[effect.value](data, width, height);
    }
    return imageData;
};

// キャンバスの更新
const updateCanvas = () => {
    if (videoRef.value && canvasRef.value && contextRef.value) {
        const ctx = contextRef.value;
        const video = videoRef.value;

        const render = () => {
            ctx.clearRect(
                0,
                0,
                canvasRef.value!.width,
                canvasRef.value!.height,
            );
            ctx.drawImage(
                video,
                0,
                0,
                canvasRef.value!.width,
                canvasRef.value!.height,
            );

            let imageData = ctx.getImageData(
                0,
                0,
                canvasRef.value!.width,
                canvasRef.value!.height,
            );
            imageData = applyEffect(imageData);
            ctx.putImageData(imageData, 0, 0);

            updateParticles(ctx);
            animationFrameId.value = requestAnimationFrame(render);
        };

        render();
    }
};

// 花火を打ち上げる
const launchFirework = () => {
    const x = Math.random() * canvasRef.value!.width;
    const y = canvasRef.value!.height;
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

// パーティクルの更新
const updateParticles = (ctx: CanvasRenderingContext2D) => {
    for (let i = particles.length - 1; i >= 0; i--) {
        const p = particles[i];
        p.vy += 0.05; // 重力
        p.x += p.vx;
        p.y += p.vy;
        p.alpha -= 0.005; // フェードアウト

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
    ctx.globalAlpha = 1; // グローバルアルファをリセット
};

onMounted(() => {
    if (canvasRef.value) {
        contextRef.value = canvasRef.value.getContext("2d", {
            willReadFrequently: true,
        });
    }
});

onUnmounted(() => {
    if (animationFrameId.value) {
        cancelAnimationFrame(animationFrameId.value);
    }
    stopCamera();
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
                width="480"
                height="640"
                autoplay
                style="display: none"
            ></video>
            <canvas ref="canvasRef" width="480" height="640"></canvas>

            <button
                @click="startCamera"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                カメラ起動
            </button>
            <button
                @click="stopCamera"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                カメラ停止
            </button>
            <button
                @click="launchFirework"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                花火をあげる
            </button>
            <div class="mt-4 space-x-2">
                <button
                    @click="() => setEffect('none')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    なし
                </button>
                <button
                    @click="() => setEffect('grayscale')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    グレースケール
                </button>
                <button
                    @click="() => setEffect('sepia')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    セピア
                </button>
                <button
                    @click="() => setEffect('invert')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    反転
                </button>
                <button
                    @click="() => setEffect('pixelate')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    ピクセル化
                </button>
                <button
                    @click="() => setEffect('blur')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    ぼかし
                </button>
                <button
                    @click="() => setEffect('neon')"
                    class="text-white bg-gray-500 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    ネオン
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
