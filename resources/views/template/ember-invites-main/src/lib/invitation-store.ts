import { useEffect, useState, useCallback } from "react";

export type EventItem = {
  id: string;
  name: string;
  date: string;
  time: string;
  venue: string;
  address: string;
  mapUrl?: string;
};

export type GalleryItem = { id: string; url: string; caption?: string };

export type StoryItem = { id: string; year: string; title: string; description: string };

export type RsvpItem = {
  id: string;
  name: string;
  attending: "hadir" | "tidak" | "ragu";
  guests: number;
  message: string;
  createdAt: string;
};

export type InvitationData = {
  eventType: string;
  brideName: string;
  brideFather: string;
  brideMother: string;
  groomName: string;
  groomFather: string;
  groomMother: string;
  quote: string;
  weddingDate: string;
  events: EventItem[];
  gallery: GalleryItem[];
  story: StoryItem[];
  rsvps: RsvpItem[];
  theme: "floral-gold" | "minimal" | "tropical" | "islamic";
  published: boolean;
};

const KEY = "invitation:data:v1";

const defaultData: InvitationData = {
  eventType: "Pernikahan",
  brideName: "Anindya Pratiwi",
  brideFather: "Bapak Suryadi",
  brideMother: "Ibu Kartika",
  groomName: "Reyhan Adiputra",
  groomFather: "Bapak Hadi",
  groomMother: "Ibu Sulastri",
  quote:
    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan hidup dari jenismu sendiri.",
  weddingDate: "2026-08-15T10:00",
  events: [
    {
      id: "akad",
      name: "Akad Nikah",
      date: "2026-08-15",
      time: "10:00",
      venue: "Masjid Al-Falah",
      address: "Jl. Melati No. 17, Bandung",
      mapUrl: "https://maps.google.com",
    },
    {
      id: "resepsi",
      name: "Resepsi",
      date: "2026-08-15",
      time: "18:00",
      venue: "Grand Ballroom Padma",
      address: "Jl. Cendana No. 21, Bandung",
      mapUrl: "https://maps.google.com",
    },
  ],
  gallery: [],
  story: [
    { id: "1", year: "2020", title: "Pertemuan", description: "Kami bertemu di sebuah kafe kecil." },
    { id: "2", year: "2023", title: "Lamaran", description: "Reyhan melamar Anindya di tepi pantai." },
  ],
  rsvps: [
    {
      id: "demo-1",
      name: "Budi Santoso",
      attending: "hadir",
      guests: 2,
      message: "Selamat menempuh hidup baru!",
      createdAt: new Date().toISOString(),
    },
  ],
  theme: "floral-gold",
  published: false,
};

function read(): InvitationData {
  if (typeof window === "undefined") return defaultData;
  try {
    const raw = localStorage.getItem(KEY);
    if (!raw) return defaultData;
    return { ...defaultData, ...JSON.parse(raw) };
  } catch {
    return defaultData;
  }
}

function write(data: InvitationData) {
  if (typeof window === "undefined") return;
  localStorage.setItem(KEY, JSON.stringify(data));
  window.dispatchEvent(new CustomEvent("invitation:update"));
}

export function useInvitation() {
  const [data, setData] = useState<InvitationData>(defaultData);
  const [hydrated, setHydrated] = useState(false);

  useEffect(() => {
    setData(read());
    setHydrated(true);
    const sync = () => setData(read());
    window.addEventListener("invitation:update", sync);
    window.addEventListener("storage", sync);
    return () => {
      window.removeEventListener("invitation:update", sync);
      window.removeEventListener("storage", sync);
    };
  }, []);

  const update = useCallback((patch: Partial<InvitationData>) => {
    setData((prev) => {
      const next = { ...prev, ...patch };
      write(next);
      return next;
    });
  }, []);

  const reset = useCallback(() => {
    write(defaultData);
    setData(defaultData);
  }, []);

  return { data, update, reset, hydrated };
}

export const uid = () => Math.random().toString(36).slice(2, 10);
