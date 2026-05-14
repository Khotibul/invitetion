import { createFileRoute, Link } from "@tanstack/react-router";
import { useInvitation } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Users, CalendarDays, ImageIcon, MessageSquare, CheckCircle2, Clock } from "lucide-react";

export const Route = createFileRoute("/dashboard/")({
  component: Overview,
});

function Overview() {
  const { data, hydrated } = useInvitation();
  const hadir = data.rsvps.filter((r) => r.attending === "hadir").length;
  const totalGuests = data.rsvps.reduce((a, r) => a + (r.attending === "hadir" ? r.guests : 0), 0);

  const stats = [
    { label: "Acara", value: data.events.length, icon: CalendarDays, color: "from-primary to-accent" },
    { label: "Foto Galeri", value: data.gallery.length, icon: ImageIcon, color: "from-accent to-primary" },
    { label: "RSVP Masuk", value: data.rsvps.length, icon: MessageSquare, color: "from-primary to-accent" },
    { label: "Tamu Hadir", value: totalGuests, icon: Users, color: "from-accent to-primary" },
  ];

  return (
    <div className="space-y-6">
      <div className="flex flex-wrap items-end justify-between gap-3">
        <div>
          <p className="text-xs uppercase tracking-[0.3em] text-gold">Selamat datang</p>
          <h1 className="font-display text-3xl md:text-4xl mt-1">
            {data.brideName.split(" ")[0]} &amp; {data.groomName.split(" ")[0]}
          </h1>
          <p className="text-muted-foreground text-sm mt-1">
            Kelola seluruh isi undangan digital Anda dari satu tempat.
          </p>
        </div>
        <Badge variant={data.published ? "default" : "secondary"} className="gap-1">
          {data.published ? <CheckCircle2 className="w-3 h-3" /> : <Clock className="w-3 h-3" />}
          {data.published ? "Dipublikasikan" : "Draft"}
        </Badge>
      </div>

      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {stats.map((s) => (
          <Card key={s.label} className="border-gold/30 shadow-card">
            <CardContent className="p-5">
              <div className={`w-10 h-10 rounded-lg bg-gradient-to-br ${s.color} grid place-items-center text-primary-foreground mb-3`}>
                <s.icon className="w-5 h-5" />
              </div>
              <div className="font-display text-3xl">{hydrated ? s.value : "—"}</div>
              <div className="text-xs uppercase tracking-widest text-muted-foreground mt-1">
                {s.label}
              </div>
            </CardContent>
          </Card>
        ))}
      </div>

      <div className="grid md:grid-cols-2 gap-6">
        <Card className="border-gold/30">
          <CardHeader>
            <CardTitle className="font-display text-2xl">Aksi Cepat</CardTitle>
          </CardHeader>
          <CardContent className="grid gap-2">
            {[
              { to: "/dashboard/mempelai", label: "Edit data mempelai" },
              { to: "/dashboard/acara", label: "Atur jadwal akad & resepsi" },
              { to: "/dashboard/galeri", label: "Tambah foto galeri" },
              { to: "/dashboard/tamu", label: "Lihat daftar RSVP" },
              { to: "/dashboard/pengaturan", label: "Publikasikan undangan" },
            ].map((l) => (
              <Link
                key={l.to}
                to={l.to}
                className="flex items-center justify-between rounded-lg border border-gold/30 bg-card/50 px-4 py-3 text-sm hover:border-gold transition"
              >
                <span>{l.label}</span>
                <span className="text-gold">→</span>
              </Link>
            ))}
          </CardContent>
        </Card>

        <Card className="border-gold/30">
          <CardHeader>
            <CardTitle className="font-display text-2xl">RSVP Terbaru</CardTitle>
          </CardHeader>
          <CardContent className="space-y-3">
            {data.rsvps.length === 0 && (
              <p className="text-sm text-muted-foreground">Belum ada RSVP masuk.</p>
            )}
            {data.rsvps.slice(-4).reverse().map((r) => (
              <div key={r.id} className="flex items-start justify-between gap-3 border-b border-gold/20 pb-3 last:border-0">
                <div>
                  <div className="font-medium text-sm">{r.name}</div>
                  <div className="text-xs text-muted-foreground line-clamp-1">{r.message}</div>
                </div>
                <Badge variant={r.attending === "hadir" ? "default" : r.attending === "tidak" ? "destructive" : "secondary"}>
                  {r.attending}
                </Badge>
              </div>
            ))}
            <div className="text-xs text-muted-foreground pt-1">
              Total hadir: <span className="text-foreground font-medium">{hadir}</span>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
