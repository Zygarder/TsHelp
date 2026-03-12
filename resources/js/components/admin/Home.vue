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
          @click="currentView = item.id"
          :class="['nav-item', { active: currentView === item.id }]"
        >
          <div class="nav-label">
            <component :is="item.icon" :size="20" />
            <span>{{ item.label }}</span>
          </div>
          <span v-if="item.count !== null" class="badge">{{ item.count }}</span>
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
        <AdminHome v-if="currentView === 'home'" />
        <SuggestionsList v-else-if="currentView === 'suggestions'" />
        </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Monitor as MonitorIcon, LogOut as LogOutIcon, FileText as FileTextIcon, 
         Clock as ClockIcon, XCircle as XCircleIcon, CheckCircle as CheckCircleIcon, 
         Lightbulb as LightbulbIcon, Home as HomeIcon } from 'lucide-vue-next';
         import AdminHome from './components/AdminHome.vue';
import SuggestionsList from './components/SuggestionsList.vue';
import ReportsList from './components/ReportsList.vue';
// Logic stays exactly the same as before
const currentView = ref('home');
const navItems = [
  { id: 'home', label: 'Home', icon: HomeIcon, count: null },
  { id: 'to-review', label: 'To Be Reviewed', icon: FileTextIcon, count: 3 },
  { id: 'pending', label: 'Pending Requests', icon: ClockIcon, count: 2 },
  { id: 'rejected', label: 'Rejected', icon: XCircleIcon, count: 1 },
  { id: 'completed', label: 'Completed', icon: CheckCircleIcon, count: 1 },
  { id: 'suggestions', label: 'Suggestions', icon: LightbulbIcon, count: 5 },
];

const viewTitle = computed(() => navItems.find(i => i.id === currentView.value)?.label || 'Home');
const viewDescription = computed(() => currentView.value === 'home' ? 'Overview of all tickets' : 'Manage your items');
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
  background: linear-gradient(to right, rgba(34, 211, 238, 0.15), rgba(59, 130, 246, 0.15));
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