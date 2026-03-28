<template>
    <div class="suggestions-container">
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-label">Total Suggestions</span>
                <span class="stat-value text-cyan">{{
                    suggestions.length
                }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Unread</span>
                <span class="stat-value text-yellow">{{ unreadCount }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Read</span>
                <span class="stat-value text-green">{{
                    suggestions.length - unreadCount
                }}</span>
            </div>
        </div>

        <div class="list-stack">
            <div
                v-for="s in suggestions"
                :key="s.id"
                :class="['suggestion-card', { unread: !s.isRead }]"
                @click="handleOpenSuggestion(s)"
            >
                <div class="card-header">
                    <span :class="['status-badge', s.isRead ? 'read' : 'new']">
                        {{ s.isRead ? "Read" : "New" }}
                    </span>
                    <button
                        @click.stop="handleMarkAsRead(s.id, s.isRead)"
                        :disabled="s.isRead"
                        :class="[
                            'icon-btn',
                            { 'opacity-50 cursor-not-allowed': s.isRead },
                        ]"
                    >
                        <EyeOffIcon v-if="s.isRead" :size="16" />
                        <EyeIcon v-else :size="16" />
                    </button>
                </div>
                <p class="card-content">{{ s.content }}</p>
                <div class="card-footer">
                    <span><UserIcon :size="14" /> {{ s.submittedBy }}</span>
                    <span
                        ><CalendarIcon :size="14" />
                        {{ new Date(s.submittedAt).toLocaleDateString() }}</span
                    >
                </div>
            </div>
        </div>
        <SuggestionModal
            v-if="isModalOpen"
            :suggestion="selectedSuggestion"
            @close="handleCloseModal"
        />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import axios from "axios";
import {
    Eye as EyeIcon,
    EyeOff as EyeOffIcon,
    User as UserIcon,
    Calendar as CalendarIcon,
} from "lucide-vue-next";
import SuggestionModal from "./SuggestionDetailModal.vue";

// 1. Accept the data from Home.vue
const props = defineProps({
    suggestionsData: {
        type: Array,
        default: () => [],
    },
});
const isModalOpen = ref(false);
const selectedSuggestion = ref(null);

// 2. Allow this component to tell Home.vue to update
const emit = defineEmits(["update"]);

// 3. COMPUTED PROPERTIES (To make your template stats work)
// This links your template's "suggestions" to the data passed from the parent
const suggestions = computed(() => props.suggestionsData);

// This automatically counts the unread items for your yellow stat card
const unreadCount = computed(() => {
    return suggestions.value.filter((s) => !s.isRead).length;
});

// 4. EVENT HANDLERS
// What happens when they click the whole card
const handleMarkAsRead = async (id, isCurrentlyRead) => {
    // Stop them right here if it's already read! No going back.
    if (isCurrentlyRead) return;

    try {
        await axios.patch(
            `http://127.0.0.1:8000/api/admin/suggestions/${id}/read`,
        );
        emit("update"); // Instantly updates the UI and counters
    } catch (error) {
        console.error("Failed to mark as read:", error);
    }
};

// The Modal open function
const handleOpenSuggestion = (suggestion) => {
    selectedSuggestion.value = suggestion;
    isModalOpen.value = true;
};

// The Modal close function (Also one-way only!)
const handleCloseModal = async () => {
    isModalOpen.value = false; // Hide modal instantly

    // If it was unread, permanently mark it as read
    if (selectedSuggestion.value && !selectedSuggestion.value.isRead) {
        try {
            await axios.patch(
                `http://127.0.0.1:8000/api/admin/suggestions/${selectedSuggestion.value.id}/read`,
            );
            emit("update"); // Instantly updates the UI and counters
        } catch (error) {
            console.error("Failed to mark as read upon closing:", error);
        }
    }

    selectedSuggestion.value = null; // Clear the data
};
</script>

<style scoped>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(15, 23, 41, 0.6);
    border: 1px solid rgba(6, 182, 212, 0.2);
    padding: 1.5rem;
    border-radius: 12px;
}

.stat-label {
    color: rgba(165, 243, 252, 0.6);
    font-size: 0.875rem;
    display: block;
}
.stat-value {
    font-size: 2rem;
    font-weight: bold;
    margin-top: 0.5rem;
    display: block;
}

.text-cyan {
    color: #22d3ee;
}
.text-yellow {
    color: #facc15;
}
.text-green {
    color: #4ade80;
}

.suggestion-card {
    background: rgba(15, 23, 41, 0.8);
    border: 1px solid rgba(6, 182, 212, 0.2);
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: 0.3s;
}

.suggestion-card.unread {
    border-color: rgba(250, 204, 21, 0.4);
}
.suggestion-card:hover {
    border-color: #22d3ee;
    transform: translateY(-2px);
}

.card-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}
.status-badge {
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 0.75rem;
    font-weight: bold;
}
.status-badge.new {
    background: rgba(250, 204, 21, 0.2);
    color: #facc15;
}
.status-badge.read {
    background: rgba(74, 222, 128, 0.2);
    color: #4ade80;
}

.card-content {
    color: #e2e8f0;
    line-height: 1.6;
    margin-bottom: 1rem;
}
.card-footer {
    display: flex;
    gap: 1.5rem;
    color: rgba(165, 243, 252, 0.4);
    font-size: 0.8rem;
}
.card-footer span {
    display: flex;
    align-items: center;
    gap: 4px;
}
</style>
