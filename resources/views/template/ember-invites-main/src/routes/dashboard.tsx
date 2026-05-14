import { createFileRoute, Link, Outlet, useRouterState } from "@tanstack/react-router";
import { LayoutDashboard, Users, CalendarDays, ImageIcon, MessageSquare, Settings, Heart, ExternalLink } from "lucide-react";
import { Toaster } from "sonner";
import {
  Sidebar,
  SidebarContent,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarProvider,
  SidebarTrigger,
  SidebarHeader,
} from "@/components/ui/sidebar";

export const Route = createFileRoute("/dashboard")({
  head: () => ({
    meta: [
      { title: "Dashboard Admin — Undangan Digital" },
      { name: "description", content: "Kelola undangan digital: mempelai, acara, galeri, RSVP, dan publikasi." },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: DashboardLayout,
});

const items = [
  { title: "Ringkasan", url: "/dashboard", icon: LayoutDashboard, exact: true },
  { title: "Mempelai", url: "/dashboard/mempelai", icon: Users },
  { title: "Acara", url: "/dashboard/acara", icon: CalendarDays },
  { title: "Galeri & Cerita", url: "/dashboard/galeri", icon: ImageIcon },
  { title: "Tamu & RSVP", url: "/dashboard/tamu", icon: MessageSquare },
  { title: "Pengaturan", url: "/dashboard/pengaturan", icon: Settings },
];

function DashboardLayout() {
  const path = useRouterState({ select: (s) => s.location.pathname });
  const isActive = (url: string, exact?: boolean) =>
    exact ? path === url : path === url || path.startsWith(url + "/");

  return (
    <SidebarProvider>
      <Toaster position="top-center" richColors />
      <div className="min-h-screen flex w-full bg-gradient-cream">
        <Sidebar collapsible="icon">
          <SidebarHeader>
            <div className="flex items-center gap-2 px-2 py-3">
              <div className="w-9 h-9 rounded-lg bg-gradient-to-br from-primary to-accent grid place-items-center text-primary-foreground">
                <Heart className="w-4 h-4" />
              </div>
              <div className="leading-tight">
                <div className="font-display text-base">Wedding CMS</div>
                <div className="text-[10px] uppercase tracking-widest text-muted-foreground">Admin Panel</div>
              </div>
            </div>
          </SidebarHeader>
          <SidebarContent>
            <SidebarGroup>
              <SidebarGroupLabel>Menu</SidebarGroupLabel>
              <SidebarGroupContent>
                <SidebarMenu>
                  {items.map((item) => (
                    <SidebarMenuItem key={item.url}>
                      <SidebarMenuButton asChild isActive={isActive(item.url, item.exact)}>
                        <Link to={item.url} className="flex items-center gap-2">
                          <item.icon className="w-4 h-4" />
                          <span>{item.title}</span>
                        </Link>
                      </SidebarMenuButton>
                    </SidebarMenuItem>
                  ))}
                </SidebarMenu>
              </SidebarGroupContent>
            </SidebarGroup>
            <SidebarGroup>
              <SidebarGroupLabel>Lihat</SidebarGroupLabel>
              <SidebarGroupContent>
                <SidebarMenu>
                  <SidebarMenuItem>
                    <SidebarMenuButton asChild>
                      <Link to="/" target="_blank" className="flex items-center gap-2">
                        <ExternalLink className="w-4 h-4" />
                        <span>Buka Undangan</span>
                      </Link>
                    </SidebarMenuButton>
                  </SidebarMenuItem>
                </SidebarMenu>
              </SidebarGroupContent>
            </SidebarGroup>
          </SidebarContent>
        </Sidebar>

        <div className="flex-1 flex flex-col min-w-0">
          <header className="h-14 flex items-center justify-between border-b border-gold/30 bg-card/60 backdrop-blur px-4 sticky top-0 z-10">
            <div className="flex items-center gap-2">
              <SidebarTrigger />
              <span className="font-display text-lg">Dashboard</span>
            </div>
            <Link
              to="/"
              target="_blank"
              className="text-xs uppercase tracking-widest text-gold hover:opacity-80"
            >
              Preview Undangan ↗
            </Link>
          </header>
          <main className="flex-1 p-6 md:p-8 max-w-6xl w-full mx-auto">
            <Outlet />
          </main>
        </div>
      </div>
    </SidebarProvider>
  );
}
