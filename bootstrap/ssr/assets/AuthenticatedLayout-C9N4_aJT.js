import { ref, onMounted, unref, useSSRContext, mergeProps, withCtx, createVNode, resolveDynamicComponent, openBlock, createBlock, createCommentVNode, toDisplayString, watch } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrIncludeBooleanAttr, ssrRenderAttrs, ssrRenderVNode, ssrRenderClass, ssrRenderSlot } from "vue/server-renderer";
import { usePage, Link } from "@inertiajs/vue3";
import { ExclamationCircleIcon, SunIcon, MoonIcon, DocumentChartBarIcon, TableCellsIcon, ChartBarIcon, DevicePhoneMobileIcon, UserIcon } from "@heroicons/vue/24/solid";
const _sfc_main$3 = {
  __name: "TopBar",
  __ssrInlineRender: true,
  setup(__props) {
    const user = usePage().props.auth.user;
    usePage();
    const currentTheme = ref("nord");
    const initializeTheme = () => {
      const savedTheme = localStorage.getItem("theme");
      if (savedTheme && (savedTheme === "nord" || savedTheme === "dim")) {
        applyTheme(savedTheme);
      } else {
        applyTheme("nord");
      }
    };
    const applyTheme = (theme) => {
      document.documentElement.setAttribute("data-theme", theme);
      currentTheme.value = theme;
      localStorage.setItem("theme", theme);
    };
    onMounted(() => {
      initializeTheme();
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[--><div class="navbar"><div class="navbar-start"><div class="dropdown"><div tabindex="0" role="button" class="btn btn-circle btn-ghost pl-1">`);
      _push(ssrRenderComponent(unref(ExclamationCircleIcon), { class: "h-6 w-6" }, null, _parent));
      _push(`</div><ul tabindex="0" class="menu dropdown-content z-[1] mt-3 w-52 rounded-box bg-base-100 p-2"><li><button onclick="about_modal.showModal()">About</button></li></ul></div></div><div class="navbar-center"><a href="/dashboard" class="btn btn-ghost text-xl">Encrypt it</a></div><div class="navbar-end"><div class="dropdown dropdown-end"><div tabindex="0" role="button" class="btn rounded-btn">${ssrInterpolate(unref(user).name)}</div><ul tabindex="0" class="menu dropdown-content z-[1] mt-4 w-52 rounded-box bg-base-100 p-2"><li><form><button type="submit">Logout</button></form></li></ul></div><label class="swap swap-rotate mx-4"><input type="checkbox" class="theme-controller hidden"${ssrIncludeBooleanAttr(currentTheme.value === "dim") ? " checked" : ""}>`);
      _push(ssrRenderComponent(unref(SunIcon), { class: "swap-off size-5" }, null, _parent));
      _push(ssrRenderComponent(unref(MoonIcon), { class: "swap-on size-5" }, null, _parent));
      _push(`</label></div></div><dialog id="about_modal" class="modal"><div class="modal-box"><h3 class="text-lg font-bold">About Encrypt It</h3><p class="py-4"> This is a simple web application that helps you encrypt and decrypt text using various encryption methods. </p><div class="modal-action"><form method="dialog"><button class="btn">Close</button></form></div></div></dialog><!--]-->`);
    };
  }
};
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/TopBar.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const _sfc_main$2 = {
  __name: "SideBarIcon",
  __ssrInlineRender: true,
  props: {
    isOpen: {
      type: Boolean,
      default: true
    },
    color: {
      type: String,
      default: "currentColor"
    },
    size: {
      type: [Number, String],
      default: 24
    }
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      if (__props.isOpen) {
        _push(`<svg${ssrRenderAttrs(mergeProps({
          fill: __props.color,
          width: __props.size,
          height: __props.size,
          viewBox: "0 -960 960 960",
          xmlns: "http://www.w3.org/2000/svg"
        }, _attrs))}><path d="M660-320v-320L500-480l160 160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm120-80v-560H200v560h120Zm80 0h360v-560H400v560Zm-80 0H200h120Z"></path></svg>`);
      } else {
        _push(`<svg${ssrRenderAttrs(mergeProps({
          fill: __props.color,
          width: __props.size,
          height: __props.size,
          viewBox: "0 -960 960 960",
          xmlns: "http://www.w3.org/2000/svg"
        }, _attrs))}><path d="M500-640v320l160-160-160-160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm120-80v-560H200v560h120Zm80 0h360v-560H400v560Zm-80 0H200h120Z"></path></svg>`);
      }
    };
  }
};
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/SideBarIcon.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const _sfc_main$1 = {
  __name: "MenuItem",
  __ssrInlineRender: true,
  props: {
    icon: {
      type: Object,
      required: true
    },
    isOpen: { type: Boolean },
    link: { type: String },
    name: { type: String, required: true }
  },
  setup(__props) {
    const isActive = (path) => {
      return window.location.pathname === path;
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<li${ssrRenderAttrs(_attrs)}>`);
      _push(ssrRenderComponent(unref(Link), {
        href: `/${__props.link}`,
        class: [
          "relative flex items-center py-4",
          {
            "bg-primary/10": isActive(`/${__props.link}`)
          },
          !__props.isOpen && "justify-center"
        ]
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            if (isActive(`/${__props.link}`)) {
              _push2(`<div class="absolute left-0 top-0 h-full w-1 bg-primary"${_scopeId}></div>`);
            } else {
              _push2(`<!---->`);
            }
            ssrRenderVNode(_push2, createVNode(resolveDynamicComponent(__props.icon), {
              class: [
                "size-5",
                {
                  "text-primary": isActive(`/${__props.link}`)
                }
              ]
            }, null), _parent2, _scopeId);
            _push2(`<span class="${ssrRenderClass(["ml-2", !__props.isOpen && "hidden"])}"${_scopeId}>${ssrInterpolate(__props.name)}</span>`);
          } else {
            return [
              isActive(`/${__props.link}`) ? (openBlock(), createBlock("div", {
                key: 0,
                class: "absolute left-0 top-0 h-full w-1 bg-primary"
              })) : createCommentVNode("", true),
              (openBlock(), createBlock(resolveDynamicComponent(__props.icon), {
                class: [
                  "size-5",
                  {
                    "text-primary": isActive(`/${__props.link}`)
                  }
                ]
              }, null, 8, ["class"])),
              createVNode("span", {
                class: ["ml-2", !__props.isOpen && "hidden"]
              }, toDisplayString(__props.name), 3)
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</li>`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/MenuItem.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "AuthenticatedLayout",
  __ssrInlineRender: true,
  setup(__props) {
    const isOpen = ref(localStorage.getItem("sidebarOpen") === "true" || false);
    watch(isOpen, (newValue) => {
      localStorage.setItem("sidebarOpen", newValue);
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "fixed size-full min-h-svh bg-base-100" }, _attrs))}><div class="fixed left-0 right-0 top-0 z-50 m-4 rounded-lg bg-base-300">`);
      _push(ssrRenderComponent(_sfc_main$3, null, null, _parent));
      _push(`</div><div class="flex flex-row justify-between pt-20"><div class="${ssrRenderClass([
        "fixed z-20 m-4 h-[calc(100vh-7rem)] flex-none shrink-0 rounded-lg bg-base-300 transition-all duration-300 ease-in-out",
        isOpen.value ? "w-48" : "w-18"
      ])}"><div class="mx-2 mt-4 flex shrink-0 items-center"><button class="btn btn-ghost flex items-center">`);
      _push(ssrRenderComponent(_sfc_main$2, { isOpen: isOpen.value }, null, _parent));
      _push(`</button><h2 class="${ssrRenderClass([
        "text-xl font-bold transition-opacity",
        isOpen.value ? "opacity-100" : "hidden opacity-0"
      ])}"> Dashboard </h2></div><div class="flex flex-1 items-start"><nav class="w-full"><ul class="menu w-full font-bold"><div class="divider my-1 shrink-0"></div>`);
      _push(ssrRenderComponent(_sfc_main$1, {
        icon: unref(DocumentChartBarIcon),
        name: `Input Data`,
        link: `inputdata`,
        isOpen: isOpen.value
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        icon: unref(TableCellsIcon),
        name: `Matrik`,
        link: `matrix`,
        isOpen: isOpen.value
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        icon: unref(ChartBarIcon),
        name: `Nilai Preferensi`,
        link: `preferensi`,
        isOpen: isOpen.value
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        icon: unref(DevicePhoneMobileIcon),
        name: `Rekomendasi`,
        link: `rekomendasi`,
        isOpen: isOpen.value
      }, null, _parent));
      _push(`<div class="divider my-1 shrink-0"></div>`);
      _push(ssrRenderComponent(_sfc_main$1, {
        icon: unref(UserIcon),
        name: `Akun`,
        link: `profile`,
        isOpen: isOpen.value
      }, null, _parent));
      _push(`</ul></nav></div></div><main class="${ssrRenderClass([
        "flex-1 overflow-auto p-4",
        { "ml-24": !isOpen.value, "ml-52": isOpen.value }
      ])}">`);
      ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
      _push(`</main></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/AuthenticatedLayout.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as _
};
