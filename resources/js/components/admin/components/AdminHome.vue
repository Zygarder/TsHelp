<template>
  <div class="admin-home">
    <section class="stats-section">
      <h3>Overview Statistics</h3>
      <div class="stats-grid">
        <div class="stat-card purple">
          <div class="stat-icon"><FileTextIcon :size="20" /></div>
          <span class="stat-label">To Review</span>
          <span class="stat-number">{{ isLoading ? '...' : stats.to_review }}</span>
        </div>
        <div class="stat-card yellow">
          <div class="stat-icon"><ClockIcon :size="20" /></div>
          <span class="stat-label">Pending</span>
          <span class="stat-number">{{ isLoading ? '...' : stats.pending }}</span>
        </div>
        <div class="stat-card green">
          <div class="stat-icon"><CheckCircleIcon :size="20" /></div>
          <span class="stat-label">Completed</span>
          <span class="stat-number">{{ isLoading ? '...' : stats.completed }}</span>
        </div>
        <div class="stat-card red">
          <div class="stat-icon"><XCircleIcon :size="20" /></div>
          <span class="stat-label">Rejected</span>
          <span class="stat-number">{{ isLoading ? '...' : stats.rejected }}</span>
        </div>
        <div class="stat-card orange">
          <div class="stat-icon"><LightbulbIcon :size="20" /></div>
          <span class="stat-label">Suggestions</span>
          <span class="stat-number">{{ isLoading ? '...' : stats.suggestions }}</span>
        </div>
      </div>
    </section>

    <section class="task-section">
      <h3>Currently Working On</h3>
      
      <div v-if="activeTask" class="task-card">
        <div class="task-header">
          <div class="task-avatar">
            <ZapIcon :size="20" />
          </div>
          <div class="task-title">
            <h4>Active Task</h4>
            <span>Priority ticket in progress</span>
          </div>
        </div>

        <div class="task-body">
          <div class="task-tags">
            <span class="tag-id">Ticket #{{ activeTask.id }}</span>
            <span class="tag-priority">{{ activeTask.urgency.toUpperCase() }}</span>
            <span class="tag-status">In Progress</span>
          </div>
          <h5>{{ activeTask.issue_category }} Issue</h5>
          <div class="task-meta">
            <span><MapPinIcon :size="14" /> {{ activeTask.lab_location }} - {{ activeTask.pc_number }}</span>
            <span><CalendarIcon :size="14" /> {{ new Date(activeTask.created_at).toLocaleDateString() }}</span>
          </div>
          <p>{{ activeTask.description }}</p>
        </div>

        <div class="task-actions">
          <button class="btn-secondary">View Details</button>
          <button class="btn-primary"><CheckIcon :size="16" /> Mark Complete</button>
        </div>
      </div>

      <div v-else-if="!isLoading" class="empty-task-card">
        <CheckCircleIcon :size="40" style="color: #22c55e; margin-bottom: 1rem;" />
        <h4>All caught up!</h4>
        <p>There are currently no tickets marked as "in-progress".</p>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { 
  FileText as FileTextIcon, Clock as ClockIcon, CheckCircle as CheckCircleIcon, 
  XCircle as XCircleIcon, Lightbulb as LightbulbIcon, Zap as ZapIcon,
  MapPin as MapPinIcon, Calendar as CalendarIcon, Check as CheckIcon
} from 'lucide-vue-next';

// 1. Reactive Variables for our data
const isLoading = ref(true);
const stats = ref({
  to_review: 0,
  pending: 0,
  completed: 0,
  rejected: 0,
  suggestions: 0
});
const activeTask = ref(null);

// 2. Fetch data from Laravel when component loads
onMounted(async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/admin/dashboard-stats'); // Or whatever your URL is
    
    // ADD THIS LINE: Let's see what Laravel actually sent!
    console.log("LARAVEL RESPONSE: ", response.data);
    
    stats.value = response.data.stats;
    activeTask.value = response.data.activeTask;
  } catch (error) {
    console.error("Error fetching dashboard stats:", error);
  } finally {
    isLoading.value = false;
  }
});
</script>

<style scoped>
/* Same CSS as before, with the "pt" typo fixed! */
h3 { color: #67e8f9; margin-bottom: 1.5rem; font-size: 1.25rem; }

.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 3rem; }
.stat-card { background: rgba(15, 23, 41, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; position: relative; overflow: hidden; }
.stat-icon { margin-bottom: 1rem; }
.stat-label { font-size: 0.875rem; color: rgba(165, 243, 252, 0.6); display: block; }
.stat-number { font-size: 2rem; font-weight: bold; margin-top: 0.5rem; display: block; }

.purple .stat-icon, .purple .stat-number { color: #a855f7; }
.yellow .stat-icon, .yellow .stat-number { color: #eab308; }
.green .stat-icon, .green .stat-number { color: #22c55e; }
.red .stat-icon, .red .stat-number { color: #ef4444; }
.orange .stat-icon, .orange .stat-number { color: #f59e0b; }

.task-card { background: linear-gradient(to bottom right, rgba(15, 23, 41, 0.8), rgba(30, 41, 59, 0.8)); border: 1px solid rgba(34, 211, 238, 0.2); border-radius: 16px; padding: 2rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); }
.task-header { display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem; }
.task-avatar { width: 48px; height: 48px; background: #0ea5e9; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
.task-title h4 { margin: 0; font-size: 1.1rem; color: #fff; }
.task-title span { font-size: 0.8rem; color: rgba(165, 243, 252, 0.5); }

.task-tags { display: flex; gap: 0.5rem; margin-bottom: 1rem; }
.tag-id { color: #22d3ee; font-family: monospace; font-weight: bold; }
.tag-priority { background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; border: 1px solid rgba(245, 158, 11, 0.3); }
.tag-status { background: rgba(234, 179, 8, 0.1); color: #eab308; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; }

.task-body h5 { font-size: 1.25rem; margin: 0.5rem 0; color: #f1f5f9; }
.task-meta { display: flex; gap: 1.5rem; color: rgba(165, 243, 252, 0.4); font-size: 0.85rem; margin-bottom: 1rem; }
.task-meta span { display: flex; align-items: center; gap: 5px; }

/* Typo fixed here! */
.task-actions { display: flex; gap: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05); margin-top: 1.5rem; padding-top: 1.5rem; }
.btn-primary { background: #059669; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: bold; }
.btn-secondary { background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; }

/* Empty state styling */
.empty-task-card { background: rgba(15, 23, 41, 0.4); border: 1px dashed rgba(34, 211, 238, 0.3); border-radius: 16px; padding: 3rem; text-align: center; color: rgba(165, 243, 252, 0.6); }
.empty-task-card h4 { color: #e2e8f0; font-size: 1.25rem; margin-bottom: 0.5rem; }
</style>