<template>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-icon">
                    <MonitorIcon :size="20" />
                </div>
                <div>
                    <h2>Admin Panel</h2>
                    <span>Tech Support System</span>
                </div>
            </div>

            <nav class="nav-menu">
    <button
        v-for="item in navItems"
        :key="item.id"
        @click="handleNavClick(item.id)"
        :class="['nav-item', { active: currentView === item.id }]"
    >
        <div class="nav-label">
            <component :is="item.icon" :size="20" />
            <span>{{ item.label }}</span>
        </div>
        <span v-if="item.count > 0" class="badge">{{ item.count }}</span>
    </button>
</nav>
            <RouterLink to="/" class="sign-out">
                <LogOutIcon :size="20" />
                <span>Sign Out</span>
            </RouterLink>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h1>{{ viewTitle }}</h1>
                <p>{{ viewDescription }}</p>
            </header>

            <div class="view-container">
                <AdminHome
                    v-if="currentView === 'home'"
                    @update="handleListUpdate"
                />
                <SuggestionsList
                    v-if="currentView === 'suggestions'"
                    :suggestionsData="suggestions"
                    @update="fetchSuggestions"
                />

                <ReportsList
                    v-else
                    :status="currentView"
                    :tickets-data="tickets"
                    @update="handleListUpdate"
                />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import {
    Monitor as MonitorIcon,
    LogOut as LogOutIcon,
    FileText as FileTextIcon,
    Clock as ClockIcon,
    XCircle as XCircleIcon,
    CheckCircle as CheckCircleIcon,
    Lightbulb as LightbulbIcon,
    Home as HomeIcon,
} from "lucide-vue-next";
import AdminHome from "./components/AdminHome.vue";
import SuggestionsList from "./components/SuggestionsList.vue";
import ReportsList from "./components/ReportsList.vue";
import axios from "axios";

// 1. STATE
const currentView = ref("home");
const tickets = ref([]);
const suggestions = ref([]);
const emit = defineEmits(["update"]);
const fetchAllTickets = async () => {
    try {
        const response = await axios.get(
            "http://127.0.0.1:8000/api/admin/tickets",
        );

        const rawTickets = response.data || [];

        tickets.value = rawTickets.map((t) => {
            // 1. Fix the "Laravel Space Trap"
            const safeDate = t.created_at
                ? t.created_at.replace(" ", "T")
                : null;
            const dateObj = safeDate ? new Date(safeDate) : null;

            return {
                id: t.id,
                ticketId: `TKT-${t.id}`,
                priority: t.urgency,
                status: t.status,
                issueType: t.issue_category,
                location: t.lab_location,
                specificItem: t.pc_number,

                // Formatted Date: "Mar 15, 2026"
                submittedAt: dateObj
                    ? dateObj.toLocaleDateString("en-US", {
                          month: "short",
                          day: "numeric",
                          year: "numeric",
                      })
                    : "No Date",

                // Formatted Time: "6:06 PM"
                submittedTime: dateObj
                    ? dateObj.toLocaleTimeString("en-US", {
                          hour: "numeric",
                          minute: "2-digit",
                          hour12: true,
                      })
                    : "",

                description: t.description,
                submittedBy: "Student",
            };
        });
    } catch (error) {
        console.error("Error fetching tickets:", error);
        tickets.value = [];
    }
};
const fetchSuggestions = async () => {
    try {
        const response = await axios.get(
            "http://127.0.0.1:8000/api/admin/suggestions",
        );

        // Laravel usually sends this back as an object with a 'suggestions' key
        const rawData = response.data.suggestions || [];
        console.log("Raw API Response:", response.data);
        suggestions.value = rawData.map((s) => ({
            id: s.id,
            content: s.content,
            // Vue mapped to what Laravel actually sent:
            isRead: Boolean(s.isRead),
            submittedBy: s.submittedBy || "Anonymous",
            submittedAt: s.submittedAt
                ? s.submittedAt.replace(" ", "T")
                : new Date().toISOString(),
        }));
    } catch (error) {
        console.error("Error fetching suggestions:", error);
        suggestions.value = [];
    }
};
onMounted(() => {
    fetchAllTickets();
    fetchSuggestions();
});

// 3. COMPUTED PROPERTIES
const counts = computed(() => ({
    toReview: tickets.value.filter(
        (t) => t.status === "open" || t.status === "pending_review",
    ).length,
    pending: tickets.value.filter((t) => t.status === "in-progress").length,
    completed: tickets.value.filter((t) => t.status === "resolved").length,
    rejected: tickets.value.filter((t) => t.status === "rejected").length,
    unreadSuggestions: suggestions.value.filter((s) => !s.isRead).length, // Make sure this matches the map in the controller
}));

// Fixed: Removed the duplicate "suggestions" entry!
const navItems = computed(() => [
    { id: "home", label: "Dashboard", icon: HomeIcon, count: null },
    {
        id: "to-review",
        label: "To Review",
        icon: FileTextIcon,
        count: counts.value.toReview,
    },
    {
        id: "pending",
        label: "In Progress",
        icon: ClockIcon,
        count: counts.value.pending,
    },
    {
        id: "completed",
        label: "Resolved",
        icon: CheckCircleIcon,
        count: counts.value.completed,
    },
    {
        id: "rejected",
        label: "Rejected",
        icon: XCircleIcon,
        count: counts.value.rejected,
    },
    {
        id: "suggestions",
        label: "Suggestions",
        icon: LightbulbIcon,
        count: counts.value.unreadSuggestions,
    },
]);

const viewTitle = computed(
    () =>
        navItems.value.find((i) => i.id === currentView.value)?.label || "Home",
);
const viewDescription = computed(() =>
    currentView.value === "home"
        ? "Overview of all tickets"
        : "Manage your items",
);

// 4. EVENT HANDLERS
const handleListUpdate = () => {
    fetchAllTickets();
};

const handleSuggestionUpdate = () => {
    fetchSuggestions();
};
const markAsComplete = async (taskId) => {
    isCompleting.value = taskId;
    try {
        // 1. Update the database
        await axios.patch(`http://127.0.0.1:8000/api/admin/tickets/${taskId}`, {
            status: "resolved",
        });

        // 2. Fetch fresh data for THIS dashboard
        await fetchDashboardData();

        emit("update");
    } catch (error) {
        console.error("Failed to complete task:", error);
        alert("Failed to update status. Please try again.");
    } finally {
        isCompleting.value = null;
    }
};
// NEW: The bulletproof navigation handler
const handleNavClick = (viewId) => {

    currentView.value = viewId;
    if (viewId === 'suggestions') {
        fetchSuggestions();
    } else if (viewId === 'home') {
    } else {

        fetchAllTickets();
    }
};
</script>

<style scoped>
/* 1. LAYOUT */
.admin-layout {
    display: flex;
    min-height: 100vh;
    background: radial-gradient(circle at top left, #0a0e1a, #050a1a);
    color: #e2e8f0;
    font-family: sans-serif;
}

/* 2. SIDEBAR */
.sidebar {
    width: 280px;
    background: rgba(15, 23, 41, 0.95);
    border-right: 1px solid rgba(6, 182, 212, 0.2);
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #22d3ee, #3b82f6);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 15px rgba(34, 211, 238, 0.4);
}

.logo-section h2 {
    font-size: 1.25rem;
    margin: 0;
    background: linear-gradient(to right, #67e8f9, #60a5fa);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.logo-section span {
    font-size: 0.75rem;
    color: rgba(165, 243, 252, 0.6);
}

/* 3. NAVIGATION */
.nav-menu {
    flex-grow: 1;
}

.nav-item {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 8px;
    color: rgba(165, 243, 252, 0.6);
    cursor: pointer;
    transition: all 0.3s;
    margin-bottom: 0.5rem;
}

.nav-item:hover {
    background: rgba(34, 211, 238, 0.1);
    color: #67e8f9;
}

.nav-item.active {
    background: linear-gradient(
        to right,
        rgba(34, 211, 238, 0.15),
        rgba(59, 130, 246, 0.15)
    );
    border: 1px solid rgba(34, 211, 238, 0.4);
    color: #67e8f9;
}

.nav-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.badge {
    background: rgba(34, 211, 238, 0.1);
    color: #22d3ee;
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 0.75rem;
}

.sign-out {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #f87171;
    text-decoration: none;
    margin-top: auto;
    border-radius: 8px;
}

.sign-out:hover {
    background: rgba(248, 113, 113, 0.1);
}

/* 4. MAIN CONTENT */
.main-content {
    flex-grow: 1;
    padding: 2rem;
    overflow-y: auto;
}

.content-header h1 {
    font-size: 2rem;
    background: linear-gradient(to right, #67e8f9, #60a5fa);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 0;
}

.content-header p {
    color: rgba(165, 243, 252, 0.6);
}
</style>
