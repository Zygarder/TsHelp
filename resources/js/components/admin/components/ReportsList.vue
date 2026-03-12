<template>
    <div class="space-y-4 font-sans">
      
      <div v-if="filteredReports.length === 0" class="text-center py-12">
        <div class="w-16 h-16 bg-cyan-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-cyan-400/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
        </div>
        <p class="text-cyan-200/60">No reports in this category</p>
      </div>
  
      <template v-else>
        <div v-for="report in filteredReports" :key="report.id" class="relative group">
          
          <div class="absolute -inset-0.5 bg-linear-to-r from-cyan-500/0 via-blue-500/0 to-cyan-500/0 group-hover:from-cyan-500/20 group-hover:via-blue-500/20 group-hover:to-cyan-500/20 rounded-lg blur transition-all"></div>
          
          <div 
            class="relative bg-linear-to-br from-[#0f1729]/80 to-[#1a2235]/80 rounded-lg p-5 border border-cyan-500/20 group-hover:border-cyan-500/40 transition-all cursor-pointer"
            @click="selectedReport = report"
          >
            <div class="flex items-start justify-between mb-3">
              
              <div class="flex items-center gap-3 flex-wrap">
                <span class="text-cyan-400 font-mono font-semibold">{{ report.ticketId }}</span>
                
                <span v-if="report.priority" :class="['px-2 py-1 rounded border text-xs font-semibold flex items-center gap-1', getPriorityColor(report.priority)]">
                  <svg v-if="report.priority === 'critical'" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                  <svg v-else-if="report.priority === 'high'" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                  <svg v-else-if="report.priority === 'medium'" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                  <svg v-else-if="report.priority === 'low'" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                  {{ report.priority.toUpperCase() }}
                </span>
                
                <span v-if="!report.priority && status === 'to-review'" class="px-2 py-1 rounded border text-xs font-semibold text-gray-400 bg-gray-500/10 border-gray-500/30">
                  Priority Not Set
                </span>
  
                <span v-if="report.status === 'to-review'" class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-300 border border-purple-500/30">New</span>
                <span v-else-if="report.status === 'pending'" class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">In Progress</span>
                <span v-else-if="report.status === 'rejected'" class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-300 border border-red-500/30">Rejected</span>
                <span v-else-if="report.status === 'completed'" class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300 border border-green-500/30">Completed</span>
              </div>
              
              <button
                v-if="status === 'to-review'"
                @click.stop="$emit('set-active', report)"
                class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-lg hover:bg-blue-500/30 transition-all border border-blue-500/30 text-sm font-semibold"
              >
                Start Working
              </button>
            </div>
  
            <h4 class="text-cyan-100 font-semibold mb-2">{{ report.issueType }}</h4>
            
            <div class="flex items-center gap-4 text-sm text-cyan-200/60 mb-3">
              <span class="flex items-center gap-1">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ report.location }} - {{ report.specificItem }}
              </span>
              <span class="flex items-center gap-1">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ new Date(report.submittedAt).toLocaleDateString() }}
              </span>
              <span class="flex items-center gap-1">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ new Date(report.submittedAt).toLocaleTimeString() }}
              </span>
            </div>
  
            <p class="text-cyan-100/80 text-sm line-clamp-2 mb-3">{{ report.description }}</p>
  
            <div class="flex items-center justify-between pt-3 border-t border-cyan-500/10">
              <span class="text-xs text-cyan-200/60">Submitted by: {{ report.submittedBy }}</span>
              <span v-if="report.assignedTo" class="text-xs text-cyan-400">Assigned to: {{ report.assignedTo }}</span>
            </div>
            
          </div>
        </div>
      </template>
  
      <ReportDetailModal
        v-if="selectedReport"
        :report="selectedReport"
        @close="selectedReport = null"
        @update="handleUpdateReport"
      />
  
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import ReportDetailModal from './ReportDetailModal.vue'; // Make sure this path is correct
  
  const props = defineProps({
    status: {
      type: String,
      required: true
    },
    reports: {
      type: Array,
      required: true
    }
  });
  
  const emit = defineEmits(['update-report', 'set-active']);
  
  const selectedReport = ref(null);
  
  // Computed property to automatically filter reports based on the passed prop status
  const filteredReports = computed(() => {
    return props.reports.filter(r => r.status === props.status);
  });
  
  const handleUpdateReport = (updatedReport) => {
    emit('update-report', updatedReport);
    selectedReport.value = null; // Close modal after update
  };
  
  // Priority Color Helper
  const getPriorityColor = (priority) => {
    switch (priority) {
      case 'critical': return 'text-red-400 bg-red-500/20 border-red-500/30';
      case 'high': return 'text-orange-400 bg-orange-500/20 border-orange-500/30';
      case 'medium': return 'text-yellow-400 bg-yellow-500/20 border-yellow-500/30';
      case 'low': return 'text-blue-400 bg-blue-500/20 border-blue-500/30';
      default: return '';
    }
  };
  </script>