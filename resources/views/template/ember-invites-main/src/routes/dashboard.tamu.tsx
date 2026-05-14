import { createFileRoute } from "@tanstack/react-router";
import { useInvitation, uid } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import {
  Table, TableBody, TableCell, TableHead, TableHeader, TableRow,
} from "@/components/ui/table";
import {
  Select, SelectContent, SelectItem, SelectTrigger, SelectValue,
} from "@/components/ui/select";
import { useState, useMemo } from "react";
import { Trash2, Download, Search } from "lucide-react";
import { toast } from "sonner";

export const Route = createFileRoute("/dashboard/tamu")({
  component: TamuPage,
});

function TamuPage() {
  const { data, update } = useInvitation();
  const [q, setQ] = useState("");
  const [filter, setFilter] = useState<"all" | "hadir" | "tidak" | "ragu">("all");
  const [form, setForm] = useState({ name: "", attending: "hadir" as const, guests: 1, message: "" });

  const filtered = useMemo(() => {
    return data.rsvps
      .filter((r) => (filter === "all" ? true : r.attending === filter))
      .filter((r) => (q ? r.name.toLowerCase().includes(q.toLowerCase()) : true))
      .slice()
      .reverse();
  }, [data.rsvps, q, filter]);

  const stats = {
    hadir: data.rsvps.filter((r) => r.attending === "hadir").length,
    tidak: data.rsvps.filter((r) => r.attending === "tidak").length,
    ragu: data.rsvps.filter((r) => r.attending === "ragu").length,
    total: data.rsvps.reduce((a, r) => a + (r.attending === "hadir" ? r.guests : 0), 0),
  };

  const addRsvp = () => {
    if (!form.name.trim()) return toast.error("Nama wajib diisi");
    update({
      rsvps: [
        ...data.rsvps,
        { id: uid(), ...form, name: form.name.trim(), createdAt: new Date().toISOString() },
      ],
    });
    setForm({ name: "", attending: "hadir", guests: 1, message: "" });
    toast.success("RSVP ditambahkan");
  };

  const removeRsvp = (id: string) => {
    update({ rsvps: data.rsvps.filter((r) => r.id !== id) });
  };

  const exportCsv = () => {
    const rows = [
      ["Nama", "Kehadiran", "Jumlah Tamu", "Pesan", "Tanggal"],
      ...data.rsvps.map((r) => [r.name, r.attending, String(r.guests), r.message.replace(/\n/g, " "), r.createdAt]),
    ];
    const csv = rows.map((r) => r.map((c) => `"${String(c).replace(/"/g, '""')}"`).join(",")).join("\n");
    const blob = new Blob([csv], { type: "text/csv;charset=utf-8" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "rsvp.csv";
    a.click();
    URL.revokeObjectURL(url);
  };

  return (
    <div className="space-y-6">
      <div className="flex items-end justify-between flex-wrap gap-3">
        <div>
          <p className="text-xs uppercase tracking-[0.3em] text-gold">Tamu</p>
          <h1 className="font-display text-3xl md:text-4xl mt-1">Daftar RSVP & Ucapan</h1>
        </div>
        <Button onClick={exportCsv} variant="outline" className="gap-2"><Download className="w-4 h-4" />Export CSV</Button>
      </div>

      <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
        {[
          { label: "Hadir", value: stats.hadir, color: "bg-primary/15 text-primary" },
          { label: "Tidak Hadir", value: stats.tidak, color: "bg-destructive/15 text-destructive" },
          { label: "Ragu", value: stats.ragu, color: "bg-accent/30 text-accent-foreground" },
          { label: "Total Tamu", value: stats.total, color: "bg-gold/20 text-gold" },
        ].map((s) => (
          <div key={s.label} className={`rounded-xl border border-gold/30 p-4 ${s.color}`}>
            <div className="font-display text-3xl">{s.value}</div>
            <div className="text-xs uppercase tracking-widest mt-1 opacity-80">{s.label}</div>
          </div>
        ))}
      </div>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl">Tambah RSVP Manual</CardTitle></CardHeader>
        <CardContent className="grid md:grid-cols-4 gap-3 items-end">
          <div className="grid gap-2">
            <Label>Nama</Label>
            <Input value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} />
          </div>
          <div className="grid gap-2">
            <Label>Kehadiran</Label>
            <Select value={form.attending} onValueChange={(v) => setForm({ ...form, attending: v as never })}>
              <SelectTrigger><SelectValue /></SelectTrigger>
              <SelectContent>
                <SelectItem value="hadir">Hadir</SelectItem>
                <SelectItem value="tidak">Tidak Hadir</SelectItem>
                <SelectItem value="ragu">Masih Ragu</SelectItem>
              </SelectContent>
            </Select>
          </div>
          <div className="grid gap-2">
            <Label>Jumlah Tamu</Label>
            <Input type="number" min={1} value={form.guests} onChange={(e) => setForm({ ...form, guests: Number(e.target.value) })} />
          </div>
          <Button onClick={addRsvp}>Tambah</Button>
          <div className="md:col-span-4 grid gap-2">
            <Label>Pesan</Label>
            <Textarea rows={2} value={form.message} onChange={(e) => setForm({ ...form, message: e.target.value })} />
          </div>
        </CardContent>
      </Card>

      <Card className="border-gold/30">
        <CardHeader className="flex flex-row items-center justify-between gap-3 flex-wrap">
          <CardTitle className="font-display text-2xl">Semua Tamu</CardTitle>
          <div className="flex items-center gap-2">
            <div className="relative">
              <Search className="w-4 h-4 absolute left-2 top-1/2 -translate-y-1/2 text-muted-foreground" />
              <Input value={q} onChange={(e) => setQ(e.target.value)} placeholder="Cari nama..." className="pl-8 w-48" />
            </div>
            <Select value={filter} onValueChange={(v) => setFilter(v as never)}>
              <SelectTrigger className="w-36"><SelectValue /></SelectTrigger>
              <SelectContent>
                <SelectItem value="all">Semua</SelectItem>
                <SelectItem value="hadir">Hadir</SelectItem>
                <SelectItem value="tidak">Tidak Hadir</SelectItem>
                <SelectItem value="ragu">Ragu</SelectItem>
              </SelectContent>
            </Select>
          </div>
        </CardHeader>
        <CardContent className="overflow-x-auto">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Nama</TableHead>
                <TableHead>Status</TableHead>
                <TableHead className="text-center">Tamu</TableHead>
                <TableHead>Pesan</TableHead>
                <TableHead className="w-12"></TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {filtered.map((r) => (
                <TableRow key={r.id}>
                  <TableCell className="font-medium">{r.name}</TableCell>
                  <TableCell>
                    <Badge variant={r.attending === "hadir" ? "default" : r.attending === "tidak" ? "destructive" : "secondary"}>
                      {r.attending}
                    </Badge>
                  </TableCell>
                  <TableCell className="text-center">{r.guests}</TableCell>
                  <TableCell className="max-w-md truncate">{r.message}</TableCell>
                  <TableCell>
                    <Button variant="ghost" size="icon" onClick={() => removeRsvp(r.id)}>
                      <Trash2 className="w-4 h-4 text-destructive" />
                    </Button>
                  </TableCell>
                </TableRow>
              ))}
              {filtered.length === 0 && (
                <TableRow>
                  <TableCell colSpan={5} className="text-center text-muted-foreground py-8">
                    Belum ada data.
                  </TableCell>
                </TableRow>
              )}
            </TableBody>
          </Table>
        </CardContent>
      </Card>
    </div>
  );
}
