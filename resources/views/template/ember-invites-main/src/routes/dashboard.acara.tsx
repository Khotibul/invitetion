import { createFileRoute } from "@tanstack/react-router";
import { useInvitation, uid, type EventItem } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import { Trash2, Plus, MapPin } from "lucide-react";
import { toast } from "sonner";

export const Route = createFileRoute("/dashboard/acara")({
  component: AcaraPage,
});

function AcaraPage() {
  const { data, update } = useInvitation();

  const patchEvent = (id: string, patch: Partial<EventItem>) => {
    update({ events: data.events.map((e) => (e.id === id ? { ...e, ...patch } : e)) });
  };

  const addEvent = () => {
    update({
      events: [
        ...data.events,
        { id: uid(), name: "Acara Baru", date: "", time: "", venue: "", address: "", mapUrl: "" },
      ],
    });
  };

  const removeEvent = (id: string) => {
    update({ events: data.events.filter((e) => e.id !== id) });
    toast.success("Acara dihapus");
  };

  return (
    <div className="space-y-6">
      <div className="flex items-end justify-between flex-wrap gap-3">
        <div>
          <p className="text-xs uppercase tracking-[0.3em] text-gold">Jadwal</p>
          <h1 className="font-display text-3xl md:text-4xl mt-1">Acara & Lokasi</h1>
        </div>
        <Button onClick={addEvent} className="gap-2"><Plus className="w-4 h-4" /> Tambah Acara</Button>
      </div>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl">Tanggal Utama</CardTitle></CardHeader>
        <CardContent>
          <div className="grid gap-2 max-w-sm">
            <Label>Tanggal & Jam Pernikahan</Label>
            <Input
              type="datetime-local"
              value={data.weddingDate}
              onChange={(e) => update({ weddingDate: e.target.value })}
            />
            <p className="text-xs text-muted-foreground">Digunakan untuk countdown di halaman undangan.</p>
          </div>
        </CardContent>
      </Card>

      <div className="grid gap-5">
        {data.events.map((ev) => (
          <Card key={ev.id} className="border-gold/30">
            <CardHeader className="flex flex-row items-center justify-between">
              <CardTitle className="font-display text-2xl flex items-center gap-2">
                <MapPin className="w-5 h-5 text-gold" />
                {ev.name || "Acara"}
              </CardTitle>
              <Button variant="ghost" size="icon" onClick={() => removeEvent(ev.id)}>
                <Trash2 className="w-4 h-4 text-destructive" />
              </Button>
            </CardHeader>
            <CardContent className="grid md:grid-cols-2 gap-4">
              <div className="grid gap-2">
                <Label>Nama Acara</Label>
                <Input value={ev.name} onChange={(e) => patchEvent(ev.id, { name: e.target.value })} />
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div className="grid gap-2">
                  <Label>Tanggal</Label>
                  <Input type="date" value={ev.date} onChange={(e) => patchEvent(ev.id, { date: e.target.value })} />
                </div>
                <div className="grid gap-2">
                  <Label>Jam</Label>
                  <Input type="time" value={ev.time} onChange={(e) => patchEvent(ev.id, { time: e.target.value })} />
                </div>
              </div>
              <div className="grid gap-2">
                <Label>Tempat</Label>
                <Input value={ev.venue} onChange={(e) => patchEvent(ev.id, { venue: e.target.value })} />
              </div>
              <div className="grid gap-2">
                <Label>Alamat</Label>
                <Input value={ev.address} onChange={(e) => patchEvent(ev.id, { address: e.target.value })} />
              </div>
              <div className="grid gap-2 md:col-span-2">
                <Label>Link Google Maps</Label>
                <Input value={ev.mapUrl ?? ""} onChange={(e) => patchEvent(ev.id, { mapUrl: e.target.value })} placeholder="https://maps.google.com/..." />
              </div>
            </CardContent>
          </Card>
        ))}
        {data.events.length === 0 && (
          <Card className="border-dashed border-gold/40">
            <CardContent className="py-12 text-center text-muted-foreground">
              Belum ada acara. Klik &ldquo;Tambah Acara&rdquo; untuk memulai.
            </CardContent>
          </Card>
        )}
      </div>
    </div>
  );
}
