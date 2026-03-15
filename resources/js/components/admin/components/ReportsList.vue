<template>
    <div class="space-y-4 font-sans">
        <div v-if="filteredReports.length === 0" class="text-center py-12">
            <div
                class="w-16 h-16 bg-cyan-500/10 rounded-full flex items-center justify-center mx-auto mb-4"
            >
                <svg
                    class="w-8 h-8 text-cyan-400/50"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="12" cy="12" r="10" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
            </div>
            <p class="text-cyan-200/60">No reports in this category</p>
        </div>

        <template v-else>
            <div
                v-for="report in filteredReports"
                :key="report.id"
                class="relative group"
            >
                <div
                    class="absolute -inset-0.5 bg-linear-to-r from-cyan-500/0 via-blue-500/0 to-cyan-500/0 group-hover:from-cyan-500/20 group-hover:via-blue-500/20 group-hover:to-cyan-500/20 rounded-lg blur transition-all"
                ></div>

                <div
                    class="relative bg-linear-to-br from-[#0f1729]/80 to-[#1a2235]/80 rounded-lg p-5 border border-cyan-500/20 group-hover:border-cyan-500/40 transition-all cursor-pointer"
                    @click="selectedReport = report"
                >
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-cyan-400 font-mono font-semibold">
                                #{{ report.id }}
                            </span>

                            <span
                                v-if="report.urgency"
                                :class="[
                                    'px-2 py-1 rounded border text-xs font-semibold flex items-center gap-1 uppercase',
                                    getPriorityColor(report.urgency),
                                ]"
                            >
                                {{ report.urgency }}
                            </span>

                            <span
                                v-if="report.status === 'open'"
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-300 border border-purple-500/30"
                                >New</span
                            >

                            <span
                                v-else-if="report.status === 'in-progress'"
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-300 border border-yellow-500/30"
                                >In Progress</span
                            >

                            <span
                                v-else-if="report.status === 'resolved'"
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300 border border-green-500/30"
                                >Completed</span
                            >
                        </div>

                        <button
                            v-if="status === 'to-review'"
                            @click.stop="$emit('set-active', report)"
                            class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-lg hover:bg-blue-500/30 transition-all border border-blue-500/30 text-sm font-semibold"
                        >
                            Start Working
                        </button>
                    </div>

                    <h4 class="text-cyan-100 font-semibold mb-2">
                        {{ report.issueType }}
                    </h4>

                    <div
                        class="flex items-center gap-4 text-sm text-cyan-200/60 mb-3"
                    >
                        <span class="flex items-center gap-1">
                            💻 {{ report.location }} - {{ report.specificItem }}
                        </span>
                        <span class="flex items-center gap-1">
                            🕒 {{ report.submittedAt }}
                            {{ report.submittedTime }}
                        </span>
                    </div>

                    <p class="text-cyan-100/80 text-sm line-clamp-2 mb-3">
                        {{ report.description }}
                    </p>
                </div>
            </div>
        </template>

        <ReportDetailModal
            v-if="selectedReport"
            :report="selectedReport"
            @close="selectedReport = null"
            @update="$emit('update')"
        />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import ReportDetailModal from "./ReportDetailModal.vue";

// 1. Updated Props: We now accept 'ticketsData' from the parent
const props = defineProps({
    status: {
        type: String,
        default: "to-review",
    },
    ticketsData: {
        type: Array,
        default: () => [],
    },
});

// 2. Define Emits: This tells the parent "Hey, something changed, refresh the DB!"
const emit = defineEmits(["update"]);

// 3. Reactive Variables
const selectedReport = ref(null);

// 4. Computed Property: This filters the data passed down from the parent
const filteredReports = computed(() => {
    return props.ticketsData.filter((ticket) => {
        if (props.status === "to-review") return ticket.status === "open";
        if (props.status === "pending") return ticket.status === "in-progress";
        if (props.status === "completed") return ticket.status === "resolved";
        if (props.status === "rejected") return ticket.status === "rejected";
        return true;
    });
});

// 5. Helper function for colors (Keep this as is)
const getPriorityColor = (priority) => {
    switch (priority) {
        case "high":
            return "text-red-400 border-red-400/30 bg-red-400/10";
        case "normal":
            return "text-yellow-400 border-yellow-400/30 bg-yellow-400/10";
        case "low":
            return "text-green-400 border-green-400/30 bg-green-400/10";
        default:
            return "text-gray-400 border-gray-400/30 bg-gray-400/10";
    }
};

// 6. Updated: Instead of updating locally, we tell the parent to refresh everything
const handleUpdateReport = () => {
    emit("update"); // This triggers fetchAllTickets() in your Home/Parent component
    selectedReport.value = null; // Close the modal
};
</script>
